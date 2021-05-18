<?php

namespace App\Http\Controllers\Api;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
 
    public function createPayment(Request $request, $id){
        //get order by id
        $order = Order::find($id)
        //$response = Http::withBasicAuth('test_8eadd736893866e0c212521298aa6c57', 'c99fd1d5-6443-4a4d-a2df-8dbb68f5d043')
        $response = Http::withBasicAuth(env('XFERS_USERNAME',''),env('XFERS_PASSWORD', ''))
        ->withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json'
 
        ])->post('https://sandbox-id.xfers.com/api/v4/payments', [
            "data" => [
                "attributes" => [
                    "paymentMethodType" => "virtual_bank_account",
                    "amount" => $order->price,
                    "referenceId" => $order->invoice_id,
                    "expiredAt" => "2021-05-19T06:07:04+07:00",
                    "description" => "Order Number ".$input['invoice_id'],
                    "paymentMethodOptions" =>[
                        "bankShortCode" => "BCA",
                        "displayName" => "Venidici",
                        "suffixNo" => ""
                    ]
 
                ]
            ]
        ]); 
 
        $payment_status = json_decode($response->body(), true);
        dd($payment_status);
    } 

    public function store()
    {
        DB::transaction(function() {

            /**
             * algorithm create no invoice
             */
            $length = 10;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $no_invoice = 'INV-'.Str::upper($random);

            $invoice = Invoice::create([
                'invoice'       => $no_invoice,
                'customer_id'   => auth()->guard('api')->user()->id,
                'courier'       => $this->request->courier,
                'service'       => $this->request->service,
                'cost_courier'  => $this->request->cost,
                'weight'        => $this->request->weight,
                'name'          => $this->request->name,
                'phone'         => $this->request->phone,
                'province'      => $this->request->province,
                'city'          => $this->request->city,
                'address'       => $this->request->address,
                'grand_total'   => $this->request->grand_total,
                'status'        => 'pending',
            ]);

            foreach (Cart::where('customer_id', auth()->guard('api')->user()->id)->get() as $cart) {

                //insert product ke table order
                $invoice->orders()->create([
                    'invoice_id'    => $invoice->id,
                    'invoice'       => $no_invoice,    
                    'product_id'    => $cart->product_id,
                    'product_name'  => $cart->product->title,
                    'image'         => $cart->product->image,
                    'qty'           => $cart->quantity,
                    'price'         => $cart->price,
                ]);

            }

            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $invoice->invoice,
                    'gross_amount'  => $invoice->grand_total,
                ],
                'customer_details' => [
                    'first_name'       => $invoice->name,
                    'email'            => auth()->guard('api')->user()->email,
                    'phone'            => $invoice->phone,
                    'shipping_address' => $invoice->address  
                ]
            ];

            //create snap token
            $snapToken = Snap::getSnapToken($payload);
            $invoice->snap_token = $snapToken;
            $invoice->save();

            $this->response['snap_token'] = $snapToken;


        });

        return response()->json([
            'success' => true,
            'message' => 'Order Successfully',  
            $this->response
        ]);

    }
    
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