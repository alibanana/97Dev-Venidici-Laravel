<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use App\Helper\Helper;
use App\Helper\XfersHelper;
use Exception;

use Axiom\Rules\TelephoneNumber;

use App\Mail\CheckoutMail;
use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Notification;

class CheckoutController extends Controller
{
    protected $request;

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

    public function storeOnlineCourse(Request $request)
    {
        $input = $request->all();
        // Remove non-numeric characters before validation.
        if ($request->has('phone'))
            $input['phone'] = preg_replace("/[^0-9 ]/", '', $input['phone']);
        
        $validated = Validator::make($input,[
            'name'                  => 'required',
            //'phone'                 => ['required', new TelephoneNumber],
            'phone'                 => 'required',
            'grand_total'           => 'required|integer',
            'total_order_price'     => 'required|integer',
            'date'                  => 'required',
            'time'                  => 'required',
            'bankShortCode'         => 'required',
            'discounted_price'      => 'integer',
            'club_discount'         => 'integer'
        ]);

        if ($validated->fails()) 
            return redirect()->back()->with('validation_error','Please complete your profile first.');

        $validated = $validated->validate();

        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        };

        $no_invoice = 'INV-'.Str::upper($random);
        
        // create invoice
        $invoice = Invoice::create([
            'invoice_no'            => $no_invoice,
            'user_id'               => auth()->user()->id,
            'name'                  => $validated['name'],
            'phone'                 => $validated['phone'],
            'grand_total'           => $validated['grand_total'],
            'status'                => 'pending',
            'total_order_price'     => $validated['total_order_price'],
            'discounted_price'      => $validated['discounted_price'],
            'club_discount'         => $validated['club_discount']
        ]);

        // Create order item & attach course to user.
        foreach (auth()->user()->carts as $cart) {
            // insert product ke table order
            $invoice->orders()->create([
                'invoice_id'    => $invoice->id,
                'course_id'     => $cart->course_id,
                'qty'           => $cart->quantity,
                'price'         => $cart->price,
                'withArtOrNo'   => $cart->withArtOrNo
            ]);
        };

        foreach (auth()->user()->carts as $cart) {
            $cart->delete();
        };

        //hit xfers api to create payment order
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))
            ->withHeaders([
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => ' '
            ])->post('https://sandbox-id.xfers.com/api/v4/payments', [
                "data" => [
                    "attributes" => [
                        "paymentMethodType" => "virtual_bank_account",
                        "amount" => $validated['grand_total'],
                        "referenceId" => $no_invoice,
                        "expiredAt" => $validated['date'].'T'.$validated['time'].'+07:00',
                        "description" => "Order Number ".$invoice->id,
                        "paymentMethodOptions" =>[
                            "bankShortCode" => $validated['bankShortCode'],
                            "displayName" => "Venidici",
                            "suffixNo" => ""
                        ]
                    ]
                ]
            ]
        );

        $payment_object = json_decode($response->body(), true);
        $invoice->xfers_payment_id = $payment_object['data']['id'];
        $invoice->save();
        
        $request->session()->forget('promotion_code');

        $courses_string = "";

        $x = 1; $length = count($invoice->orders);
        foreach($invoice->orders as $order)
        {
            if($x == $length && $length != 1)
                $courses_string = $courses_string." dan ";
            
            elseif($x != 1)
                $courses_string = $courses_string.", ";

            $courses_string = $courses_string.$order->course->title;
            $x++;
        }

        // create notification
        $notification = Notification::create([
            'user_id'           => auth()->user()->id,
            'invoice_id'        => $invoice->id,
            'isInformation'     => 0,
            'title'             => 'Kami masih menunggu pembayaran kamu..   ',
            'description'       => 'Hi, '.auth()->user()->name.'. Harap segera selesaikan pembayaranmu untuk pelatihan: '.$courses_string,
            'link'              => '/transaction-detail/'.$payment_object['data']['id']
        ]);
        $link = '/transaction-detail/'.$payment_object['data']['id'];
        
        //email if there's no woki
        Mail::to(auth()->user()->email)->send(new CheckoutMail($invoice,$courses_string,$link));
        
        return $payment_object['data']['id'];
    }

    
    public function store(Request $request){
        $input = $request->all();
        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        };

        $no_invoice = 'INV-'.Str::upper($random);

        // Checks if somehow the cart data does not exists.
        // This could be caused by:
        // [1] User submitted the request twice (on second occasion cart data has been deleted).
        if (!auth()->user()->carts()->exists()) {
            // Checks if the user has invoices data. If not.. simply redirect him back.
            if (auth()->user()->invoices()->exists()) {
                $invoice = auth()->user()->invoices()->latest()->first();
                $invoice_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $invoice->created_at);
                // If an invoice (of this user) was created recently redirect to that invoice.
                if ($invoice_created_at->between(Carbon::now()->subSeconds(30), Carbon::now()))
                    return redirect()->route('customer.cart.transactionDetail', $invoice->xfers_payment_id);
            }
            return redirect()->back();
        }

        if($request->action == 'createPaymentObjectWithNoWoki'){
            if($request->session()->get('promotion_code') != null) {
                $used_promo = Promotion::findOrFail($request->session()->get('promotion_code')->id);
                if($used_promo->user_id != null) {
                    $used_promo->isActive = FALSE;
                    $used_promo->save();
                }
            }

            $xfers_id = app('App\Http\Controllers\Api\CheckoutController')->storeOnlineCourse($request);
            
            return redirect('/transaction-detail/'.$xfers_id.'#payment-created');
        }
        
        // Remove non-numeric characters before validation.
        if ($request->has('phone'))
            $input['phone'] = preg_replace("/[^0-9 ]/", '', $input['phone']);

        $validated = Validator::make($input, [
            'courier'               => 'required',
            'service'               => 'required',
            'cost_courier'          => 'required',
            'total_weight'          => 'required|integer',
            'name'                  => 'required',
            //'phone'                 => ['required', new TelephoneNumber],
            'phone'                 => 'required',
            'province'              => 'integer',
            'city'                  => 'integer',
            'address'               => 'required',
            'grand_total'           => 'required|integer',
            'total_order_price'     => 'required|integer',
            'date'                  => 'required',
            'time'                  => 'required',
            'bankShortCode'         => 'required',
            'discounted_price'      => 'integer',
            'club_discount'         => 'integer'
        ])->validate();

        // kalo user udah pernah save province di user detail
        if($validated['province'] == null)
            $validated['province'] = auth()->user()->userDetail->province_id;

        // kalo user udah pernah save city di user detail
        if($validated['city'] == null)
            $validated['city'] = auth()->user()->userDetail->city_id;
        
        // create invoice
        $invoice = Invoice::create([
            'invoice_no'            => $no_invoice,
            'user_id'               => auth()->user()->id,
            'courier'               => $validated['courier'],
            'service'               => $validated['service'],
            'cost_courier'          => $validated['cost_courier'],
            'total_weight'          => $validated['total_weight'],
            'name'                  => $validated['name'],
            'phone'                 => $validated['phone'],
            'province'              => $validated['province'],
            'city'                  => $validated['city'],
            'address'               => $validated['address'],
            'grand_total'           => $validated['grand_total'],
            'status'                => 'pending',
            'total_order_price'     => $validated['total_order_price'],
            'discounted_price'      => $validated['discounted_price'],
            'club_discount'         => $validated['club_discount']
        ]);

        if ($request->has('shipping_notes')) {
            $invoice->shipping_notes = $request->shipping_notes;
            $invoice->save();
        }

        // Create order item & attach course to user.
        foreach (auth()->user()->carts as $cart) {
            // insert product ke table order
            $invoice->orders()->create([
                'invoice_id'    => $invoice->id,
                'course_id'     => $cart->course_id,
                'qty'           => $cart->quantity,
                'price'         => $cart->price,
                'withArtOrNo'   => $cart->withArtOrNo
            ]);
        };

        //hit xfers api to create payment order
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))
            ->withHeaders([
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json'
            ])->post('https://sandbox-id.xfers.com/api/v4/payments', [
                "data" => [
                    "attributes" => [
                        "paymentMethodType" => "virtual_bank_account",
                        "amount" => $validated['grand_total'],
                        "referenceId" => $no_invoice,
                        "expiredAt" => $validated['date'].'T'.$validated['time'].'+07:00',
                        "description" => "Order Number ".$invoice->id,
                        "paymentMethodOptions" =>[
                            "bankShortCode" => $validated['bankShortCode'],
                            "displayName" => "Venidici",
                            "suffixNo" => ""
                        ]
                    ]
                ]
            ]
        ); 
        
        $payment_object = json_decode($response->body(), true);
        $invoice->xfers_payment_id = $payment_object['data']['id'];
        $invoice->save();

        foreach (auth()->user()->carts as $cart) {
            $cart->delete();
        };
        
        if($request->session()->get('promotion_code') != null)
            {
                $used_promo = Promotion::findOrFail($request->session()->get('promotion_code')->id);
                if($used_promo->user_id != 'null')
                {
                    $used_promo->isActive = FALSE;
                    $used_promo->save();
                }
            }
        
        $request->session()->forget('promotion_code');


        $courses_string = "";

        $x = 1;
        $length = count($invoice->orders);
        foreach($invoice->orders as $order)
        {
            if($x == $length && $length != 1)
                $courses_string = $courses_string." dan ";
            
            elseif($x != 1)
                $courses_string = $courses_string.", ";

            $courses_string = $courses_string.$order->course->title;
            $x++;
        }

        // create notification
        $notification = Notification::create([
            'user_id'           => auth()->user()->id,
            'invoice_id'        => $invoice->id,
            'isInformation'     => 0,
            'title'             => 'Kami masih menunggu pembayaran kamu..',
            'description'       => 'Hi, '.auth()->user()->name.'. Harap segera selesaikan pembayaranmu untuk pelatihan: '.$courses_string,
            'link'              => '/transaction-detail/'.$payment_object['data']['id']
        ]);
        
        $link = '/transaction-detail/'.$payment_object['data']['id'];
        //email if there's no woki
        Mail::to(auth()->user()->email)->send(new CheckoutMail($invoice,$courses_string,$link));
        return redirect('/transaction-detail/'.$payment_object['data']['id'].'#payment-created');
    }

    public function newStore(Request $request) {
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

        // Create payment object (in xfers) & handle failed.
        $response = XfersHelper::createPayment($request->only([
            'grand_total', 'date', 'time', 'bankShortCode'
        ]), $invoiceNumberResult['data'], $invoice->id);
        if ($response['status'] == 'Failed')
            return redirect()->back()->with('message', $response['errors']['message']);

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

        // Send CheckoutMail email to user.
        try {
            Mail::to(auth()->user()->email)
                ->send(new CheckoutMail($invoice, $courses_string, $link));
        } catch (Exception $e) {
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
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        
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
            foreach($invoice->orders as $order)
            {
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

        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
        
        $transactions = Notification::where([   
            ['user_id', '=', auth()->user()->id],
            ['isInformation', '=', 0],
        ])->orderBy('created_at', 'desc')->get();

        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        $noWoki = TRUE;
        foreach($orders as $order)
        {
            if($order->course->course_type_id == 2)
                $noWoki = FALSE;
        }
        $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('client/transaction-detail', compact('payment_object','orders','invoice','cart_count','transactions','informations','noWoki','notifications'));
    }

    public function createPayment(Request $request, $id){    
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }    

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

        return view('client/transaction-detail', compact('payment_status','orders','invoice','cart_count','transactions','informations','noWoki','notifications'));
    }

    public function cancelPayment(Request $request, $id) {
        $result = XfersHelper::cancelPayment($id);

        if ($result['status'] == 'Failed')
            return redirect()->back()->with('message', $result['errors']['message']);

        $payment_object = $result['data'];

        $invoice = Invoice::where('xfers_payment_id', $id)->first();

        // start of courses string
        $courses_string = "";

        $x = 1;
        $length = count($invoice->orders);
        foreach($invoice->orders as $order)
        {
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

        // Check if cart object has artKit.
        $cartHasNoArtKit = $this->checkCartHasNoArtKit();

        // If promo is meant for shipping & cart has no artKit (no shipping)
        if ($promo->promo_for == 'shipping' && $cartHasNoArtKit) {
            $request->session()->forget('promotion_code');
            $message_topic = 'discount_not_found';
            $message_value = 'Discount Code is for Shipping!';
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