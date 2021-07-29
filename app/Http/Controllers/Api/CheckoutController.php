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
use App\Models\ReferralCodeCounter;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\BootcampApplication;

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
        if (!auth()->user()->carts()->exists() && $request->action != 'createPaymentObjectBootcamp') {
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
        if ($request->has('telephone'))
            $input['telephone'] = preg_replace("/[^0-9 ]/", '', $input['telephone']);

        if($request->action == 'createPaymentObjectBootcamp'){
            // Validation rules that exists on all validation conditions. (bootcamp)
            $validation_rules = [
                'name'                  => 'required',
                'email'                 => 'required',
                'birth_place'           => 'required',
                'birth_date'            => 'required',
                'gender'                => 'required',
                // 'telephone'          => ['required', new TelephoneNumber],
                'telephone'             => 'required',
                'province_id'           => 'required',
                'city_id'               => 'required',
                'address'               => 'required',
                'last_degree'           => 'required',
                'institution'           => 'required',
                'batch'                 => 'required',
                'sumber_tahu_program'   => '',
                'mencari_kerja'         => 'required',
                'social_media'          => 'required',
                'konsiderasi_lanjut'    => 'required',
                'kenapa_memilih'        => 'required',
                'expectation'           => 'required',
                'bankShortCode'         => 'required',
                'bank_account_no'       => 'required',
                'promo_code'            => '', // no validations but included for ease of access.
                'course_id'             => '', // no validations but included for ease of access.
                'grand_total'           => 'required|integer',
                'total_order_price'     => 'required|integer',
                'discounted_price'      => 'required|integer',
                'club_discount'         => 'required|integer',
                'date'                  => 'required',
                'time'                  => 'required',
                'course_id'             => '', // no validations but included for ease of access.

            ];
        }
        else{
            // Validation rules that exists on all validation conditions. (noArtKit, hasArtKit)
            $validation_rules = [
                'name' => 'required',
                'phone' => ['required', new TelephoneNumber],
                // 'phone' => 'required',
                'grand_total' => 'required|integer',
                'total_order_price' => 'required|integer',
                'date' => 'required',
                'time' => 'required',
                'bankShortCode' => 'required',
                'discounted_price' => 'required|integer',
                'promo_code' => '', // no validations but included for ease of access.
                'club_discount' => 'required|integer',
                'course_id' => '', // no validations but included for ease of access.
            ];

        }


        // Extra validation rules if orders has artKit.
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
        // Extra validation rules for bootcamp payments.
        // elseif ($request->action == 'createPaymentObjectBootcamp') {
        //     $validation_rules = array_merge($validation_rules, [
        //         'email' => 'required',
        //         'address' => 'required',
        //         'bank_account_number' => 'required|integer'
        //     ]);
        // }

        $validator = Validator::make($input, $validation_rules);
        // Handle validation failed
        if ($validator->fails()) {
            $profile_data = ['name', 'phone'];
            if ($request->action == 'createPaymentObject')
                $profile_data = array_merge($profile_data, ['province', 'city', 'address']);
            $messages = $validator->messages()->toArray();

            //if user does not buy a bootcamp
            if ($request->action != 'createPaymentObjectBootcamp') {
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

            // Kalau error field lainnya dan user buys a bootcamp
            // return redirect(route('bootcamp.show', $input['course_id']) . '#payment')->withErrors($validator);
            return redirect('/bootcamp#free-trial')->withErrors($validator)->withInput($request->all());

        }



        // If validation passed store validated data in a variable.
        $validated = $validator->validate();

        $invoiceNumberResult = Helper::generateInvoiceNumber();
        if ($invoiceNumberResult['status'] == 'Failed'){
            if ($request->action == 'createPaymentObjectBootcamp')
                // return redirect()->route('bootcamp.show', $validated['course_id'])
                //     ->with('message', $invoiceNumberResult['message']);
                return redirect('/bootcamp#free-trial')->with('full_registration_bootcamp_message', $invoiceNumberResult['message']);
            else
                return redirect()->back()->with('message', $invoiceNumberResult['message']);
        }

        if ($request->action == 'createPaymentObjectBootcamp') {
            // Invoice data if bootcamp
            $invoice_data = [
                'invoice_no' => $invoiceNumberResult['data'],
                'user_id' => auth()->user()->id,
                'name' => $validated['name'],
                'phone' => $validated['telephone'],
                'status' => 'pending',
                'total_order_price' => $validated['total_order_price'],
                'discounted_price' => $validated['discounted_price'],
                'club_discount' => $validated['club_discount'],
                'grand_total' => $validated['grand_total']
            ];
        }
        else{
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
            
        }

    
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
        if (!$invoice->exists){
            if ($request->action == 'createPaymentObjectBootcamp')
                return redirect('/bootcamp#free-trial')->with('full_registration_bootcamp_message', 'Oops, something went wrong..');

            else
                return redirect()->back()->with('message', 'Oops, something went wrong..');
        }
        
        /* 
        * Handle order (or orders) object creation, as well as additional steps after order creation.
        * For Bootcamp payments :
        *  - Create 1 order object with data directly taken from the request.
        *  - Validate if order creation success -> create bootcamp_application object.
        *  - Validate if bootcamp_application creation success.
        */
        if ($request->action == 'createPaymentObjectBootcamp') {
            $order = Order::create([
                'invoice_id' => $invoice->id,
                'course_id' => $validated['course_id'],
                'qty' => 1,
                'price' => $validated['total_order_price']
            ]);

            // Handle if order creation failed.
            if (!$order->exists) {
                $invoice->orders()->delete();
                $invoice->delete();
                // return redirect()->route('bootcamp.show', $validated['course_id'])
                //     ->with('message', 'Oops, something went wrong..');
                return redirect('/bootcamp#free-trial')->with('full_registration_bootcamp_message', 'Oops, something went wrong..');

            }

            // Create bootcamp_application object.
            $bootcamp_application = BootcampApplication::create([
                'course_id'             => $validated['course_id'],
                'user_id'               => auth()->user()->id,
                'invoice_id'            => $invoice->id,
                'name'                  => $validated['name'],
                'email'                 => $validated['email'],
                'birth_place'           => $validated['birth_place'],
                'birth_date'            => $validated['birth_date'],
                'gender'                => $validated['gender'],
                'phone_no'              => $validated['telephone'],
                'province_id'           => $validated['province_id'],
                'city_id'               => $validated['city_id'],
                'address'               => $validated['address'],
                'last_degree'           => $validated['last_degree'],
                'institution'           => $validated['institution'],
                'batch'                 => $validated['batch'],
                'sumber_tahu_program'   => $validated['sumber_tahu_program'],
                'mencari_kerja'         => $validated['mencari_kerja'],
                'social_media'          => $validated['social_media'],
                'konsiderasi_lanjut'    => $validated['konsiderasi_lanjut'],
                'kenapa_memilih'        => $validated['kenapa_memilih'],
                'expectation'           => $validated['expectation'],
                'is_trial'              => 1,
                'status'                => "pending",
                
            ]);

            // Handle if bootcamp_application creation failed.
            if (!$bootcamp_application->exists) {
                $invoice->orders()->delete();
                $invoice->bootcampApplication()->delete();
                $invoice->delete();
                // return redirect()->route('bootcamp.show', $validated['course_id'])
                //     ->with('message', 'Oops, something went wrong..');
                return redirect('/bootcamp#free-trial')->with('full_registration_bootcamp_message', 'Oops, something went wrong..');

            }
        /* 
        * For Non-Bootcamp payments :
        *  - Create orders object from user's carts data & validate if order creation success.
        *  - Delete user's carts data after object creation.
        *  - Handle personal promocode usage.
        */
        } else {
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
        }
        // Create payment object (in xfers) & handle failed.
        $response = $validated['bankShortCode'] == 'qris' ?
            XfersHelper::createQRISPayment($request->only(['grand_total', 'date', 'time']), $invoiceNumberResult['data'], $invoice->id) :
            XfersHelper::createPayment($request->only(['grand_total', 'date', 'time', 'bankShortCode']), $invoiceNumberResult['data'], $invoice->id);
            if ($response['status'] == 'Failed') {
                $invoice->orders()->delete();
                $invoice->delete();
                if ($request->action == 'createPaymentObjectBootcamp')
                    // return redirect()->route('bootcamp.show', $validated['course_id'])
                    //     ->with('message', $response['errors']['message']);
                    return redirect('/bootcamp#free-trial')->with('full_registration_bootcamp_message', $response['errors']['message']);

                else
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
            //if user buys a bootcamp
            if ($request->action == 'createPaymentObjectBootcamp')
                // return redirect('bootcamp/'.$input['course_id'])->back()->with('message','Oops, something went wrong..');
                return redirect('/bootcamp#free-trial')->with('full_registration_bootcamp_message', 'Oops, something went wrong..');

            //if user does not buy a bootcamp
            else
                return redirect()->back()->with('message', 'Oops, something went wrong..');
            
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

            $isUserFirstTransactionFlag = $this->isUserFirstTransaction();

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
                // Add stars to user based on how much the user paid.
                $star_mulitiplication = (int) ($invoice->grand_total / 30000);
                $star_added = $star_mulitiplication * 12;
                if($star_added != 0)
                    Helper::addStars(auth()->user(), $star_added, 'Pembelian Venidici On-Demand');

                // Check if user registered with a referral code && the user has registered on the current month &&
                // that its the user's first transaction.
                $referred_by_code = auth()->user()->userDetail->referred_by_code;
                if ($referred_by_code && $this->isUserCreatedAtDateValid() && $isUserFirstTransactionFlag) {
                    // Get referral code counter for a particular referral_code for this month.
                    $referralCodeCounter = $this->getReferralCodeCounterByReferralCode($referred_by_code);
                    if ($referralCodeCounter->counter < 5) {
                        $referralCodeCounter->counter += 1;
                        $referralCodeCounter->save();
                        // Add 60 points to the owner of the referred_by_code & to the current user.
                        Helper::addStars(User::find($referralCodeCounter->user_id), 60, 'penggunaan Referral Code kamu');
                        Helper::addStars(auth()->user(), 60 , 'penggunaan Referral Code '. $referred_by_code);
                    }
                }

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


            if($payment_status == 'paid' || $payment_status == 'completed') {
                foreach($invoice->notifications as $notif) {
                    if($notif->user_id == auth()->user()->id && $notif->invoice_id == $invoice->id) {
                        $notif->title = 'Pembayaran Telah Berhasil!';
                        $notif->description = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah berhasil.';
                        $notif->save();
                    }
                }
            } elseif ($payment_status == 'expired') {
                foreach($invoice->notifications as $notif) {
                    if($notif->user_id == auth()->user()->id && $notif->invoice_id == $invoice->id) {
                        $notif->title = 'Pembarayan Kadaluarsa!';
                        $notif->description = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah dibatalkan.';
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
                $notif->title        = 'Pembayaran Telah Dibatalkan!';
                $notif->description  = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah dibatalkan.';
                $notif->save();
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

    // Method to check if user's cart data containes artKit.
    private function checkCartHasNoArtKit() {
        foreach (auth()->user()->carts as $cart) {
            if($cart->withArtOrNo) return false;
        }
        return true;
    }

    // Method to generate a dynamic message for transaction notification.
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

    // Method to check if user has registered on the current month.
    private function isUserCreatedAtDateValid() {
        $createdAt = Carbon::parse(auth()->user()->created_at);
        $createdAtPlus30Days = Carbon::parse(auth()->user()->created_at)->addDays(30);
        return Carbon::now()->between($createdAt, $createdAtPlus30Days);
    }

    // Method to check if current transaction is the user's first transaction.
    private function isUserFirstTransaction() {
        $paidOrCompletedInvoices = auth()->user()->invoices()
            ->where('status', 'paid')->orWhere('status', 'completed')->get();
        return $paidOrCompletedInvoices->isEmpty();
    }

    // Method to get referralCodeCounter data by referralCode. If not found,
    // create new referralCodeCounter data.
    private function getReferralCodeCounterByReferralCode($referral_code) {
        $referralCodeCounter = ReferralCodeCounter::where('referral_code', $referral_code)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->first();
            // ->whereDate('created_at', Carbon::today())->first(); // Buat testing.
        if (!$referralCodeCounter) {
            $user_id = UserDetail::where('referral_code', $referral_code)->first()->user_id;
            return ReferralCodeCounter::create([
                'user_id' => $user_id,
                'referral_code' => $referral_code
            ]);
        }
        return $referralCodeCounter;
    }
}