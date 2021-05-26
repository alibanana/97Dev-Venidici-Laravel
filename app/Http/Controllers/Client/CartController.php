<?php

namespace App\Http\Controllers\Client;
use Cookie;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Promotion;   

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index()
    {
        $carts = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
        $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();
        $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('client/cart', compact('carts','cart_count','transactions'));
    }
    
    public function shipment_index(Request $request)
    {
        $carts = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
        $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();

        $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $today = Carbon::now()->addDays(1);
        $today->setTimezone('Asia/Jakarta');
        $total_price = 0;
        $sub_total = 0;
        $shipping_cost = 0;
        $tipe_pengiriman = null;

        foreach($carts as $cart)
        {
            $sub_total += $cart->quantity * $cart->course->price;
        }
        $provinces = Province::all();

        if ($request->has('province')) {
            $province_id = $request['province'];
            $cities = City::where('province_id', $province_id)->get();
        }
        else{
            if(auth()->user()->userDetail->city_id != null)
                $cities = City::get();
            else
                $cities = null;
        }

        if ($request->has('shipping')) {
            $city_id = $request['city'];

            //kalo user udah pernah save city di user detail
            if($city_id == null)
                $city_id = auth()->user()->userDetail->city_id;

            $courier_type = $request['shipping'];
            $response = RajaOngkir::ongkosKirim([
                'origin'        => 153,  //kode jaksel
                'destination'   => $city_id, // ID kota/kabupaten tujuan
                'weight'        => 1000, // berat barang dalam gram
                'courier'       => $courier_type // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();
            //$shipping_cost = $response[0]['costs'][0]['cost'][0]['value'];
            $tipe_pengiriman = $response[0]['costs']; // contoh ctc
        }

        if ($request->has('tipe')) {
            $nama_tipe = $request['tipe'];
            foreach($tipe_pengiriman as $tipe)
            {
                if($tipe['service'] == $nama_tipe)
                    $shipping_cost = $tipe['cost'][0]['value'];
            }
        }
        $total_price = $sub_total + $shipping_cost;

        return view('client/cart-shipping', compact('carts','cart_count','provinces','cities','sub_total','shipping_cost','tipe_pengiriman','total_price','today','transactions'));
    }

    public function store(Request $request)
    {
        $item = Cart::where('course_id', $request->course_id)->where('user_id', $request->user_id);

        if ($item->count()) {
            //increment quantity
            $item->increment('quantity');
            $item = $item->first();
            //sum price * quantity
            $price = $request->price * $item->quantity;
            //sum weight
            $weight = $request->weight * $item->quantity;
            $item->update([
                'price' => $price,
                'weight'=> $weight
            ]);
        } else {
            $item = Cart::create([
                'course_id'    => $request->course_id,
                'user_id'   => $request->user_id,
                'quantity'      => $request->quantity,
                'price'         => $request->price,
                'weight'        => $request->weight
            ]);
        }
       
        $request->session()->put('cart_count',$request->session()->get('cart_count')+1);  

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function getCartTotal()
    {
        $carts = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('price');
        
        return redirect()->back()->with('success', 'Total Cart Price: '.$carts);

    }

    public function getCartTotalWeight()
    {
        $carts = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('weight');
        
        return redirect()->back()->with('success', 'Total Cart Price: '.$carts);

    }

    public function removeCart(Request $request ,$cart_id)
    {
        // Cart::with('course')
        //         ->whereId($request->cart_id)
        //         ->delete();
        $cart= Cart::findOrFail($cart_id);
        $request->session()->put('cart_count',$request->session()->get('cart_count')-$cart->quantity);  
        $cart->delete();
        return redirect()->back()->with('success', 'Item Removed');
    }
    public function increaseQty(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->quantity = $cart->quantity+1;
        $cart->price = $cart->price+$cart->price;
        $cart->save();
        $request->session()->put('cart_count',$request->session()->get('cart_count')+1);  

        return redirect()->back();
    }
    public function decreaseQty(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->quantity = $cart->quantity-1;
        $cart->price = $cart->price-$cart->course->price;

        $cart->save();
        $request->session()->put('cart_count',$request->session()->get('cart_count')-1);  

        return redirect()->back();
    }

    //public function payment_index(Request $request){
        //return view('client/cart-payment');
    //}
    
    public function checkDiscount()
    {
        



    }


    
    /**
     * removeAllCart
     *
     * @param  mixed $request
     * @return void
     */
    // public function removeAllCart(Request $request)
    // {
    //     Cart::with('course')
    //             ->where('user_id', auth()->guard('api')->user()->id)
    //             ->delete();
        
    //     return redirect()->back()->with('success', 'Removed All Item in Cart');

    // }
}
