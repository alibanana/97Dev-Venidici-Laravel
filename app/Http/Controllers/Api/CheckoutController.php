<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Midtrans\Snap;
use Carbon\Carbon;

use Axiom\Rules\TelephoneNumber;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Notification;

class CheckoutController extends Controller
{
    protected $request;     

    /**
     * __construct
     *
     * @return void
     */
    public function getBankStatus(Request $request, $id){
        //EXAMPLE GET REQUEST
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))->get('https://sandbox-id.xfers.com/api/v4/payments/'.$id);
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

        
        $validated = Validator::make($input, [
            'name'                  => 'required',
            //'phone'                 => ['required', new TelephoneNumber],
            'phone'                 => 'required',
            'grand_total'           => 'required|integer',
            'total_order_price'     => 'required|integer',
            'date'                  => 'required',
            'time'                  => 'required',
            'bankShortCode'         => 'required',
            'discounted_price'      => 'integer'
        ])->validate();

        if($request->action == 'checkDiscount') {
            $validated = $request->validate([
                'code' => 'required'
            ]);
            $today = Carbon::now()->addDays(1);

            $promo = Promotion::where('code', $validated['code'])->first();
            if(!$promo) return redirect()->back()->with('discount_not_found','Discount Code tidak ditemukan');
            
            $request->session()->put('promotion_code', $promo);
            return redirect()->back()->with('discount_found','Discount Code applied');
        }

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
            'discounted_price'      => $validated['discounted_price']
        ]);

        // Create order item & attach course to user.
        foreach (auth()->user()->carts as $cart) {
            // insert product ke table order
            $invoice->orders()->create([
                'invoice_id'    => $invoice->id,
                'course_id'     => $cart->course_id,
                'qty'           => $cart->quantity,
                'price'         => $cart->price,
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
            'title'             => 'Kami masih menunggu pembayaran kamu..   ',
            'description'       => 'Hi, '.auth()->user()->name.'. Harap segera selesaikan pembayaranmu untuk pelatihan: '.$courses_string,
            'link'              => '/transaction-detail/'.$payment_object['data']['id']
        ]);
        
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

        if($request->action == 'checkDiscount') {
            $validated = $request->validate([
                'code' => 'required'
            ]);

            //get current date
            $today = explode(' ', Carbon::now());
            $date=$today[0];

            $promo = Promotion::where([   
                ['code', '=', $validated['code']],
                ['finish_date', '>=', $date]
            ])->first();
    

            //1. check if promo is still valid (compare date)
            if($promo != null)
            {
                //2. check if the promo is global or for the user
                if($promo->user_id == 'null')
                {
                    return redirect()->back()->with('discount_found','Discount Code applied');
                    $request->session()->put('promotion_code', $promo);
                }
                //if the promo is for personal user
                else{
                    if($promo->user_id != auth()->user()->id)
                    {
                        $request->session()->forget('promotion_code');
                        return redirect()->back()->with('discount_not_found','Discount Code tidak bisa digunakan');
                    }

                    //check whether the user has used the promo
                    if($promo->isActive){
                        $noWoki = TRUE;    
                        foreach (auth()->user()->carts as $cart) {
                            if($cart->course->course_type_id == 2) $noWoki = FALSE;
                        }
                        //check whether the code is for shippping and there is no woki in cart
                        if($promo->promo_for == 'shipping' && $noWoki)
                        {
                            $request->session()->forget('promotion_code');
                            return redirect()->back()->with('discount_not_found','Discount Code is for Shipping');
                        }

                        //if all conditions applied
                        else
                        {
                            $request->session()->put('promotion_code', $promo);
                            return redirect()->back()->with('discount_found','Discount Code applied');
                        }
                    }
                    // if the user has used the promo
                    else{
                        $request->session()->forget('promotion_code');
                        return redirect()->back()->with('discount_not_found','Discount Code telah digunakan');
                    }
                }
            }
            //if current date has pas finish_date
            else{
                $request->session()->forget('promotion_code');
                return redirect()->back()->with('discount_not_found','Discount Code tidak ada atau telah expired');
            }
            
        }


        if($request->action == 'createPaymentObjectWithNoWoki'){
            if($request->session()->get('promotion_code') != null)
            {
                $used_promo = Promotion::findOrFail($request->session()->get('promotion_code')->id);
                if($used_promo->user_id != null)
                {
                    $used_promo->isActive = FALSE;
                    $used_promo->save();
                }
            }
            $xfers_id = app('App\Http\Controllers\Api\CheckoutController')->storeOnlineCourse($request);
            return redirect('/transaction-detail/'.$xfers_id.'#payment-created');
        } 

        //if all item is free courses
        if($request->action == 'createOrderFree'){
            // create invoice
            $invoice = Invoice::create([
                'invoice_no'            => $no_invoice,
                'user_id'               => auth()->user()->id,
                'name'                  => auth()->user()->name,
                'phone'                 => auth()->user()->userDetail->telephone,
                'grand_total'           => 0,
                'status'                => 'completed',
                'total_order_price'     => 0,
                'xfers_payment_id'      => $no_invoice,
            ]);

            // Create order item & attach course to user.
            foreach (auth()->user()->carts as $cart) {
                // insert product ke table order
                $invoice->orders()->create([
                    'invoice_id'    => $invoice->id,
                    'course_id'     => $cart->course_id,
                    'qty'           => $cart->quantity,
                    'price'         => $cart->price,
                ]);
            };
            foreach (auth()->user()->carts as $cart) {
                $cart->delete();
            };
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
                'title'             => 'Pembayaran Telah Berhasil!',
                'description'       => 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah berhasil.',
                'link'              => '/transaction-detail/'.$no_invoice
            ]);
            
            foreach ($invoice->orders as $order) {
                $course = $order->course;
                if (!auth()->user()->courses->contains($course->id)) {
                    auth()->user()->courses()->attach($course->id);
                    if ($course->assessment()->exists()) {
                        auth()->user()->assessments()->attach($course->assessment->id);
                    }
                }
            }

            return redirect('/transaction-detail/'.$no_invoice.'#payment-success');
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
            'discounted_price'      => 'required|integer'
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
            'discounted_price'      => $validated['discounted_price']
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
        

        return redirect('/transaction-detail/'.$payment_object['data']['id'].'#payment-created');
    }
    
    public function transactionDetail($id){
        
        $invoice = Invoice::where('xfers_payment_id',$id)->first();
        $payment_status = null;

        if ($invoice->status == 'pending') {
            $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))->get('https://sandbox-id.xfers.com/api/v4/payments/'.$id);
            $payment_status = json_decode($response->body(), true);
            $invoice->status = $payment_status['data']['attributes']['status'];
            $invoice->save();

            // If invoice's status was updated from pending to paid, this means that the user have just paid.
            // Therefore, courses & assessments should be mapped to that particular user.
            if ($invoice->status == 'paid') {
                foreach ($invoice->orders as $order) {
                    $course = $order->course;
                    if (!auth()->user()->courses->contains($course->id)) {
                        auth()->user()->courses()->attach($course->id);
                        if ($course->assessment()->exists()) {
                            auth()->user()->assessments()->attach($course->assessment->id);
                        }
                    }
                }
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


            if($payment_status['data']['attributes']['status'] == 'paid' || $payment_status['data']['attributes']['status'] == 'completed')
            {
                foreach($invoice->notifications as $notif)
                {
                    if($notif->user_id == auth()->user()->id && $notif->invoice_id == $invoice->id)
                        $newNotif = Notification::findOrFail($notif->id);
                        $newNotif->title        = 'Pembayaran Telah Berhasil!';
                        $newNotif->description  = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah berhasil.';
                        $newNotif->save();
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
        
        $transactions = Notification::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0],
            ]
        )->orderBy('created_at', 'desc')->get();

        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        $noWoki = TRUE;
        foreach($orders as $order)
        {
            if($order->course->course_type_id == 2)
                $noWoki = FALSE;
        }
        $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('client/transaction-detail', compact('payment_status','orders','invoice','cart_count','transactions','informations','noWoki','notifications'));
    }

    public function createPayment(Request $request, $id){        

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

    public function cancelPayment(Request $request, $id)
    {
        //hit xfers api to cancel payment
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))
        ->withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json'
 
        ])->post('https://sandbox-id.xfers.com/api/v4/payments/'.$id.'/tasks', [
            "data" => [
                "attributes" => [
                    "action" => "cancel"
                ]
            ]
        ]); 

        $payment_object = json_decode($response->body(), true);

        $invoice = Invoice::where('xfers_payment_id',$id)->first();

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

        foreach($invoice->notifications as $notif)
        {
            if($notif->user_id == auth()->user()->id && $notif->invoice_id == $invoice->id)
                $newNotif = Notification::findOrFail($notif->id);
                $newNotif->title        = 'Pembayaran Telah Dibatalkan!';
                $newNotif->description  = 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah dibatalkan.';
                $newNotif->save();
        }
        return redirect('/transaction-detail/'.$payment_object['data']['attributes']['targetId']);

    }
    public function receivePayment(Request $request, $id)
    {
        //hit xfers api to cancel payment
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))
        ->withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json'
 
        ])->post('https://sandbox-id.xfers.com/api/v4/payments/'.$id.'/tasks', [
            "data" => [
                "attributes" => [
                    "action" => "receive_payment"
                ]
            ]
        ]); 

        $payment_object = json_decode($response->body(), true);

        
        return redirect('/transaction-detail/'.$payment_object['data']['attributes']['targetId']);

    }

}