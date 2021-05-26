<?php

namespace App\Http\Controllers\Api;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
    
    public function store(Request $request){
        $input = $request->all();

        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        };

        $no_invoice = 'INV-'.Str::upper($random);

        // kalo user udah pernah save province di user detail
        if($input['province'] == null)
            $input['province'] = auth()->user()->userDetail->province_id;

        // kalo user udah pernah save city di user detail
        if($input['city'] == null)
            $input['city'] = auth()->user()->userDetail->city_id;
        
        // create invoice
        $invoice = Invoice::create([
            'invoice_no'            => $no_invoice,
            'user_id'               => auth()->user()->id,
            'courier'               => $input['courier'],
            'service'               => $input['service'],
            'cost_courier'          => $input['cost_courier'],
            'total_weight'          => $input['weight'],
            'name'                  => $input['name'],
            'phone'                 => $input['phone'],
            'province'              => $input['province'],
            'city'                  => $input['city'],
            'address'               => $input['address'],
            'shipping_notes'        => $input['shipping_notes'],
            'grand_total'           => $input['grand_total'],
            'status'                => 'pending',
            'total_order_price'     => $input['total_order_price'],
            'discounted_price'      => 200
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

            if (!auth()->user()->courses->contains($cart->course_id))
                auth()->user()->courses()->attach($cart->course_id);
        };

        $invoice_id = Invoice::latest()->first()->id;

        //hit xfers api to create payment order
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))
            ->withHeaders([
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json'
            ])->post('https://sandbox-id.xfers.com/api/v4/payments', [
                "data" => [
                    "attributes" => [
                        "paymentMethodType" => "virtual_bank_account",
                        "amount" => $input['grand_total'],
                        "referenceId" => $no_invoice,
                        "expiredAt" => $input['date'].'T'.$input['time'].'+07:00',
                        "description" => "Order Number ".$invoice_id,
                        "paymentMethodOptions" =>[
                            "bankShortCode" => $input['bankShortCode'],
                            "displayName" => "Venidici",
                            "suffixNo" => ""
                        ]
                    ]
                ]
            ]
        ); 
        
        $payment_object = json_decode($response->body(), true);
        $invoice = Invoice::findorfail($invoice_id);
        $invoice->xfers_payment_id  =  $payment_object['data']['id'];
        $invoice->save();

        foreach (auth()->user()->carts as $cart) {
            $cart->delete();
        };

        return redirect('/transaction-detail/'.$payment_object['data']['id']);
    }
    
    public function transactionDetail($id){

        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))->get('https://sandbox-id.xfers.com/api/v4/payments/'.$id);

        $payment_status = json_decode($response->body(), true);

        $invoice = Invoice::where('xfers_payment_id',$id)->first();

        $orders = Order::with('course')
                ->where('invoice_id', $invoice->id)
                ->orderBy('created_at', 'desc')
                ->get();

        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
        $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('client/transaction-detail', compact('payment_status','orders','invoice','cart_count','transactions'));
    }

    public function createPayment(Request $request, $id){        
        
        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
        $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('client/transaction-detail', compact('payment_status','orders','invoice','cart_count','transactions'));
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
                    "action" => "receive_payment"
                ]
            ]
        ]); 

        $payment_object = json_decode($response->body(), true);
        return redirect('/transaction-detail/'.$payment_object['data']['attributes']['targetId']);

    }

    // public function store()
    // {
    //     DB::transaction(function() {

    //         /**
    //          * algorithm create no invoice
    //          */
    //         $length = 10;
    //         $random = '';
    //         for ($i = 0; $i < $length; $i++) {
    //             $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
    //         }

    //         $no_invoice = 'INV-'.Str::upper($random);

    //         $invoice = Invoice::create([
    //             'invoice'       => $no_invoice,
    //             'customer_id'   => auth()->guard('api')->user()->id,
    //             'courier'       => $this->request->courier,
    //             'service'       => $this->request->service,
    //             'cost_courier'  => $this->request->cost,
    //             'weight'        => $this->request->weight,
    //             'name'          => $this->request->name,
    //             'phone'         => $this->request->phone,
    //             'province'      => $this->request->province,
    //             'city'          => $this->request->city,
    //             'address'       => $this->request->address,
    //             'grand_total'   => $this->request->grand_total,
    //             'status'        => 'pending',
    //         ]);

    //         foreach (Cart::where('customer_id', auth()->guard('api')->user()->id)->get() as $cart) {

    //             //insert product ke table order
    //             $invoice->orders()->create([
    //                 'invoice_id'    => $invoice->id,
    //                 'invoice'       => $no_invoice,    
    //                 'product_id'    => $cart->product_id,
    //                 'product_name'  => $cart->product->title,
    //                 'image'         => $cart->product->image,
    //                 'qty'           => $cart->quantity,
    //                 'price'         => $cart->price,
    //             ]);

    //         }

    //         // Buat transaksi ke midtrans kemudian save snap tokennya.
    //         $payload = [
    //             'transaction_details' => [
    //                 'order_id'      => $invoice->invoice,
    //                 'gross_amount'  => $invoice->grand_total,
    //             ],
    //             'customer_details' => [
    //                 'first_name'       => $invoice->name,
    //                 'email'            => auth()->guard('api')->user()->email,
    //                 'phone'            => $invoice->phone,
    //                 'shipping_address' => $invoice->address  
    //             ]
    //         ];

    //         //create snap token
    //         $snapToken = Snap::getSnapToken($payload);
    //         $invoice->snap_token = $snapToken;
    //         $invoice->save();

    //         $this->response['snap_token'] = $snapToken;


    //     });

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Order Successfully',  
    //         $this->response
    //     ]);

    // }
    
    /**
     * notificationHandler
     *
     * @param  mixed $request
     * @return void
     */
    public function notificationHandler(Request $request)
    {
        $payload      = $request->getContent();
        $notification = json_decode($payload);
      
        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transaction  = $notification->transaction_status;
        $type         = $notification->payment_type;
        $orderId      = $notification->order_id;
        $fraud        = $notification->fraud_status;

        //data tranaction
        $data_transaction = Invoice::where('invoice', $orderId)->first();

        if ($transaction == 'capture') {
 
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

              if($fraud == 'challenge') {
                
                /**
                *   update invoice to pending
                */
                $data_transaction->update([
                    'status' => 'pending'
                ]);

              } else {
                
                /**
                *   update invoice to success
                */
                $data_transaction->update([
                    'status' => 'success'
                ]);

              }

            }

        } elseif ($transaction == 'settlement') {

            /**
            *   update invoice to success
            */
            $data_transaction->update([
                'status' => 'success'
            ]);


        } elseif($transaction == 'pending'){

            
            /**
            *   update invoice to pending
            */
            $data_transaction->update([
                'status' => 'pending'
            ]);


        } elseif ($transaction == 'deny') {

            
            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'status' => 'failed'
            ]);


        } elseif ($transaction == 'expire') {

            
            /**
            *   update invoice to expired
            */
            $data_transaction->update([
                'status' => 'expired'
            ]);


        } elseif ($transaction == 'cancel') {

            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'status' => 'failed'
            ]);

        }

    }
}