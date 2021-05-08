<?php

namespace App\Http\Controllers\Client;
use Cookie;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;

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
        return view('client/cart', compact('carts','cart_count'));
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
        $sub_total = 0;
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
            $cities = null;
        }

        if ($request->has('city')) {
            $city_id = $request['city'];

            // $cost = RajaOngkir::ongkosKirim([
            //     'origin'        => 153,  //kode jaksel
            //     'destination'   => $city_id, // ID kota/kabupaten tujuan
            //     'weight'        => '200', // berat barang dalam gram
            //     'courier'       => 'JNE' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            // ])->get();
            // dd($cost);
        }

        return view('client/cart-shipping', compact('carts','cart_count','provinces','cities','sub_total'));
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

    public function removeCart($cart_id)
    {
        // Cart::with('course')
        //         ->whereId($request->cart_id)
        //         ->delete();
        Cart::findOrFail($cart_id)->delete();
        
        return redirect()->back()->with('success', 'Item Removed');
    }
    public function increaseQty(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->quantity = $cart->quantity+1;
        $cart->price = $cart->price+$cart->price;
        $cart->save();
        return redirect()->back();
    }
    public function decreaseQty(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->quantity = $cart->quantity-1;
        $cart->price = $cart->price-$cart->course->price;

        $cart->save();
        return redirect()->back();
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
