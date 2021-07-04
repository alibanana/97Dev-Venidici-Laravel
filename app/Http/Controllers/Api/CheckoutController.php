<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use App\Helper\Helper;
use App\Helper\XfersHelper;
use Throwable;

use Axiom\Rules\TelephoneNumber;

use App\Mail\CheckoutMail;
use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Notification;
use App\Models\Review;

class CheckoutController extends Controller
{
    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $navbarData = Helper::getNavbarData();
        $this->notifications = $navbarData['notifications'];
        $this->informations = $navbarData['informations'];
        $this->transactions = $navbarData['transactions'];
        $this->cart_count = $navbarData['cart_count'];
    }

    public function getBankStatus(Request $request, $id){
        //EXAMPLE GET REQUEST
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''), env('XFERS_PASSWORD', ''))
            ->get('https://sandbox-id.xfers.com/api/v4/payments/'.$id);
        $payment_status = json_decode($response->body(), true);
    }

    public function promo(Request $request, $id){
        $promotion = Promotion::where('code', $request->code)->first();

        if(!$promotion){
            return redirect()->back()->with('error','Invalid coupon code');
        }

        session()->put('promotion', [
            'name'      -> $promotion->code,
            'discount'  -> $promotion-> discount,
        ]);

        return redirect()->back()->with('success', 'Coupon has been applied');
    }

    public function store(Request $request) {
        // Checks if somehow the cart data does not exists.
        // This could be caused by:
        // [1] User submitted the request twice (on second occasion cart data has been deleted).
        if (!auth()->user()->carts()->exists()) {
            // Checks if the user has invoices data. If not.. simply redirect him back.
            if (auth()->user()->invoices()->exists()) {
                $invoice = auth()->user()->invoices()->latest()->first();
                $invoice_created_at = Carbon::createFromFormat('Y-m-d h:i:s', $invoice->created_at);
                // If an invoice (of this user) was created recently redirect to that invoice.
                if ($invoice_created_at->between(Carbon::now()->subSeconds(30), Carbon::now()))
                    return redirect()->route('customer.cart.transactionDetail', $invoice->xfers_payment_id);
            }
            return redirect()->back();
        }

        $input = $request->all();

        // Convert request input "phone" format.
        if ($request->has('phone'))
            $input['phone'] = preg_replace("/[^0-9 ]/", '', $input['phone']);

        // validation rules if no artKit.
        $validation_rules = [
            'name' => 'required',
            'phone' => ['required', new TelephoneNumber],
            'grand_total' => 'required|integer',
            'total_order_price' => 'required|integer',
            'date' => 'required',
            'time' => 'required',
            'bankShortCode' => 'required',
            'discounted_price' => 'required|integer',
            'promo_code' => '', // no validations but included for ease of access.
            'club_discount' => 'required|integer'
        ];

        // Validations if orders has artKit.
        if ($request->action == 'createPaymentObject') {
            $validation_rules = array_merge($validation_rules, [
                'courier' => 'required',
                'service' => 'required',
                'cost_courier' => 'required',
                'total_weight' => 'required|integer',
                'province' => 'required|integer',
                'city' => 'required|integer',
                'address' => 'required'
            ]);
        }

        $validator = Validator::make($input, $validation_rules);

        // Handle validation failed
        if ($validator->fails()) {
            $profile_data = ['name', 'phone'];
            if ($request->action == 'createPaymentObject')
                $profile_data = array_merge($profile_data, ['province', 'city', 'address']);
            $messages = $validator->messages()->toArray();
            foreach ($messages as $key => $value) {
                // Kalau field userDetail yang diperlukan belum di-isi.
                if (in_array($key, $profile_data))
                    return redirect()->back()
                        ->with('validation_error', 'Please complete your profile first.')
                        ->withErrors($validator);
            }
            // Kalau error field lainnya.
            return redirect()->back()->withErrors($validator);
        }

        // If validation passed store validated data in a variable.
        $validated = $validator->validate();

        $invoiceNumberResult = Helper::generateInvoiceNumber();
        if ($invoiceNumberResult['status'] == 'Failed')
            return redirect()->back()->with('message', $invoiceNumberResult['message']);

        // Invoice data if no artKit.
        $invoice_data = [
            'invoice_no' => $invoiceNumberResult['data'],
            'user_id' => auth()->user()->id,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'status' => 'pending',
            'promo_code' => $validated['promo_code'],
            'total_order_price' => $validated['total_order_price'],
            'discounted_price' => $validated['discounted_price'],
            'club_discount' => $validated['club_discount'],
            'grand_total' => $validated['grand_total']
        ];

        // Invoice data if order has artKit.
        if ($request->action == 'createPaymentObject') {
            $invoice_data = array_merge($invoice_data, [ 
                'courier' => $validated['courier'],
                'service' => $validated['service'],
                'cost_courier' => $validated['cost_courier'],
                'total_weight' => $validated['total_weight'],
                'province' => $validated['province'],
                'city' => $validated['city'],
                'address' => $validated['address']
            ]);

            if ($request->has('shipping_notes'))
                $invoice_data['shipping_notes'] = $request->shipping_notes;
        }

        // Create Invoice object and validate if it failed.
        $invoice = Invoice::create($invoice_data);
        if (!$invoice->exists)
            return redirect()->back()->with('message', 'Oops, something went wrong..');

        // Create order items.
        foreach (auth()->user()->carts as $cart) {
            $order = Order::create([
                'invoice_id' => $invoice->id,
                'course_id' => $cart->course_id,
                'qty' => $cart->quantity,
                'price' => $cart->price,
                'withArtOrNo' => $cart->withArtOrNo
            ]);

            // Handle if order creation failed.
            if (!$order->exists) {
                $invoice->orders()->delete();
                $invoice->delete();
                return redirect()->back()
                    ->with('message', 'Oops, something went wrong..');
            }
        }

        // Delete user's cart data.
        auth()->user()->carts()->delete();

        // Handle if promo_code used is a personal promo_code. If its personal,
        // change isActive flag to false.
        if ($validated['promo_code']) {
            $promoObject = Promotion::where('code', $validated['promo_code'])->first();
            if ($promoObject->user_id) {
                $promoObject->isActive = false;
                $promoObject->save();
            }
        }

        // Create payment object (in xfers) & handle failed.
        $response = XfersHelper::createPayment($request->only([
            'grand_total', 'date', 'time', 'bankShortCode'
        ]), $invoiceNumberResult['data'], $invoice->id);
        if ($response['status'] == 'Failed') {
            $invoice->orders()->delete();
            $invoice->delete();
            return redirect()->back()->with('message', $response['errors']['message']);
        }

        $payment_object = $response['data'];

        // Save xfers_payment_id into invoice created.
        $invoice->xfers_payment_id = $payment_object['data']['id'];

        // Handle if invoice is not saved -> retry max 5x
        $isInvoiceSaved = $invoice->save(); $counter = 1;
        while (!$isInvoiceSaved && $counter < 5) {
            $isInvoiceSaved = $invoice->save();
            $counter++;
        }

        // If invoiced save still failed :
        // [1] Cancel Xfers Payment, [2] Delete orders in DB, [3] Delete invoice in DB.
        if (!$isInvoiceSaved) {
            $cancelPaymentResult = XfersHelper::cancelPayment($payment_object['data']['id']);
            $counterCancelPayment = 1;

            // Handle Xfers payment cancellation failed.
            while ($cancelPaymentResult['status'] == 'Failed' && $counterCancelPayment < 5) {
                $cancelPaymentResult = XfersHelper::cancelPayment($payment_object['data']['id']);
                $counterCancelPayment++;
            }

            $invoice->orders()->delete();
            $invoice->delete();
            return redirect()->back()
                ->with('message', 'Oops, something went wrong..');
        }

        $courses_string = $this->generateDescriptionStringForNotification($invoice);

        $notification_data = [
            'user_id' => auth()->user()->id,
            'invoice_id' => $invoice->id,
            'isInformation' => 0,
            'title' => 'Kami masih menunggu pembayaran kamu..   ',
            'description' => 'Hi, '.auth()->user()->name.'. Harap segera selesaikan pembayaranmu untuk pelatihan: '.$courses_string,
            'link' => '/transaction-detail/'.$payment_object['data']['id']
        ];

        // Create notification for user.
        $notification = Notification::create($notification_data);

        // Handle notification creation failed.
        $counterNotificationCreate = 1;
        while (!$notification->exists && $counterNotificationCreate < 5) {
            $notification = Notification::create($notification_data);
            $counterNotificationCreate++;
        }

        // If notification creation still failed, redirect user to transcation
        // details page with error message.
        if (!$notification->exists) {
            return redirect(
                route('customer.cart.transactionDetail', $invoice->xfers_payment_id) . '#payment-created'
            )->with(
                'message', 
                "Oops, seems like we're having trouble creating your notification.
                Please save this link to update & check your payment status!");
        }

        $request->session()->forget('promotion_code');

        // Link to transaction detail page.
        $link = route('customer.cart.transactionDetail', $invoice->xfers_payment_id) . '#payment-created';

        // Send CheckoutMail email to user.
        try {
            Mail::to(auth()->user()->email)
                ->send(new CheckoutMail($invoice, $courses_string, $link));
        } catch (Throwable $e) {
            if (!App::environment('production')) dd($e->getMessage());
            return redirect(
                route('customer.cart.transactionDetail', $invoice->xfers_payment_id) . '#payment-created'
            )->with(
                'message', 
                "Oops, seems like we're having trouble sending your email regarding invoice details.
                Please save this link to update & check your payment status!");
        }

        return redirect(
            route('customer.cart.transactionDetail', $invoice->xfers_payment_id) . '#payment-created');
    }
    
    public function transactionDetail($id) {
        Helper::mobileViewNotReady();
        
        $invoice = Invoice::where('xfers_payment_id', $id)->firstOrFail();
        $payment_object = null;

        if ($invoice->status == 'pending') {
            $result = XfersHelper::getPaymentDetail($id);
            if ($result['status'] == 'Failed')
                return redirect()->back()->with('message', $result['errors']['message']);

            $payment_object = $result['data'];
            $payment_status = $payment_object['data']['attributes']['status'];

            $invoice->status = $payment_status;
            $invoice->save();

            // If invoice's status was updated from pending to paid, this means that the user have just paid.
            // Therefore, courses & assessments should be mapped to that particular user.
            if ($invoice->status == 'paid' || $invoice->status == 'completed') {
                foreach ($invoice->orders as $order) {
                    $course = $order->course;
                    if (!auth()->user()->courses->contains($course->id)) {
                        auth()->user()->courses()->syncWithoutDetaching([$course->id]);
                        if ($course->assessment()->exists()) {
                            auth()->user()->assessments()->attach($course->assessment->id);
                        }
                    }
                }
                // add stars to user
                $star_mulitiplication = (int)($invoice->grand_total/30000);
                $star_added = $star_mulitiplication*12;
                if($star_added != 0)
                    Helper::addStars(auth()->user(),$star_added,'Pembelian Venidici On-Demand');
                Mail::to(auth()->user()->email)->send(new InvoiceMail($invoice));
            }

            // start of courses string
            $courses_string = "";

            $x = 1;
            $length = count($invoice->orders);
            foreach ($invoice->orders as $order) {
                if($x == $length && $length != 1)
                    $courses_string = $courses_string." dan ";
                elseif($x != 1)
                    $courses_string = $courses_string.", ";
    
                $courses_string = $courses_string.$order->course->title;
                $x++;
            }
            // end of courses string


            if($payment_status == 'paid' || $payment_status == 'completed')
            {
                foreach($invoice->notifications as $notif)
                {
                    if($notif->user_id == auth()->user()->id && $notif->invoice_id == $invoice->id) {
                        $notif->title = 'Pembayaran Telah Berhasil!';
                        $notif->description = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah berhasil.';
                        $notif->save();
                    }
                }
            }
        }

        $orders = Order::with('course')
            ->where('invoice_id', $invoice->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $noWoki = TRUE;
        foreach($orders as $order) {
            if($order->course->course_type_id == 2)
                $noWoki = FALSE;
        }

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/transaction-detail', compact('notifications', 'informations', 'transactions', 'cart_count', 
            'payment_object', 'orders', 'invoice','noWoki','footer_reviews'));
    }

    public function createPayment(Request $request, $id){    
        Helper::mobileViewNotReady();

        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
            $transactions = Notification::where(
                [   
                    ['user_id', '=', auth()->user()->id],
                    ['isInformation', '=', 0],
                    
                ]
            )->orderBy('created_at', 'desc')->get();
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();

        $noWoki = TRUE;
        foreach(auth()->user()->carts as $cart)
        {
            if($cart->course->course_type_id == 2)
                $noWoki = FALSE;
        }
        $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/transaction-detail', compact('payment_status','orders','invoice','cart_count','transactions','informations','noWoki','notifications','footer_reviews'));
    }

    public function cancelPayment(Request $request, $id) {
        $result = XfersHelper::cancelPayment($id);

        if ($result['status'] == 'Failed')
            return redirect()->back()->with('message', $result['errors']['message']);

        $payment_object = $result['data'];

        $invoice = Invoice::where('xfers_payment_id', $id)->first();

        // If promotions_code used is a personal one, change is_active back.
        $promotion = $invoice->promo_code ? Promotion::where('code', $invoice->promo_code)->first() : null;
        if ($promotion) {
            $promotion->isActive = $promotion->user_id ? true : $promotion->isActive;
            $promotion->save();
        }

        // start of courses string
        $courses_string = ""; $x = 1; $length = count($invoice->orders);
        foreach($invoice->orders as $order) {
            if($x == $length && $length != 1)
                $courses_string = $courses_string." dan ";
            elseif($x != 1)
                $courses_string = $courses_string.", ";

            $courses_string = $courses_string.$order->course->title;
            $x++;
        }
        // end of courses string

        foreach ($invoice->notifications as $notif) {
            if($notif->user_id == auth()->user()->id && $notif->invoice_id == $invoice->id)
                $newNotif = Notification::findOrFail($notif->id);
                $newNotif->title        = 'Pembayaran Telah Dibatalkan!';
                $newNotif->description  = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah dibatalkan.';
                $newNotif->save();
        }

        return redirect('/transaction-detail/'.$payment_object['data']['attributes']['targetId']);

    }

    public function receivePayment(Request $request, $id) {
        $result = XfersHelper::simulatePayment($id);
        if ($result['status'] == 'Failed')
            return redirect()->back()->with('message', $result['errors']['message']);
            
        $payment_object = $result['data'];
        
        return redirect('/transaction-detail/'.$payment_object['data']['attributes']['targetId']);
    }

    // Function to validate a voucher code.
    public function validateVoucherCode(Request $request) {
        $date = Carbon::now()->format('Y-m-d');

        if (is_null($request->code)) {
            $request->session()->forget('promotion_code');
            return redirect()->back();
        }

        $promo = Promotion::where([   
            ['code', '=', $request->code],
            ['finish_date', '>=', $date]
        ])->first();
        
        // Check if promo code exists or not valid.
        if ($promo == null) {
            $request->session()->forget('promotion_code');
            $message_topic = 'discount_not_found';
            $message_value = 'Discount Code tidak ada atau telah expired';
            return redirect()->back()->with($message_topic, $message_value);
        }

        // Check if cart object has artKit. (if yes, this means order will have shipping)
        $cartHasNoArtKit = $this->checkCartHasNoArtKit();

        // Validations if the promo_code is for shipping.
        if ($promo->promo_for =='shipping') {
            // If cart object has no artKit. (no shipping)
            if ($cartHasNoArtKit) {
                $request->session()->forget('promotion_code');
                $message_topic = 'discount_not_found';
                $message_value = 'Discount Code is for Shipping!';
                return redirect()->back()->with($message_topic, $message_value);
            // If cart object has artKit (order has shippings), but its not calculated yet.
            } else if ($request->shipping_cost == 0) {
                $request->session()->forget('promotion_code');
                $message_topic = 'discount_not_found';
                $message_value = 'Please choose a shipping destination first!';
                return redirect()->back()->with($message_topic, $message_value);
            }
        }

        // Check if promo code global -> Apply Code.
        if ($promo->user_id == null) {
            $request->session()->put('promotion_code', $promo);
            $message_topic = 'discount_found';
            $message_value = 'Discount Code Applied!';
            return redirect()->back()->with($message_topic, $message_value);
        }

        // Check if personal promo code belongs to user.
        if ($promo->user_id != auth()->user()->id) {
            $request->session()->forget('promotion_code');
            $message_topic = 'discount_not_found';
            $message_value = 'Discount Code tidak bisa digunakan!';
            return redirect()->back()->with($message_topic, $message_value);
        }

        // Check if the user has used the promo.
        if (!$promo->isActive) {
            $request->session()->forget('promotion_code');
            $message_topic = 'discount_not_found';
            $message_value = 'Discount Code telah digunakan!';
            return redirect()->back()->with($message_topic, $message_value);
        }

        // All conditions has been met.
        $request->session()->put('promotion_code', $promo);
        $message_topic = 'discount_found';
        $message_value = 'Discount Code Applied!';
        return redirect()->back()->with($message_topic, $message_value);
    }

    private function checkCartHasNoArtKit() {
        foreach (auth()->user()->carts as $cart) {
            if($cart->withArtOrNo) return false;
        }
        return true;
    }

    private function generateDescriptionStringForNotification(Invoice $invoice) {
        $string = ""; $x = 1; $length = count($invoice->orders);
        foreach ($invoice->orders as $order) {
            if($x == $length && $length != 1)
                $string = $string." dan ";
            elseif($x != 1)
                $string = $string.", ";

            $string = $string.$order->course->title;
            $x++;
        }
        return $string;
    }

}