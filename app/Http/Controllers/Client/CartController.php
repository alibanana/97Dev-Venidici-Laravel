<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        
                return view('client/cart', compact('carts'));
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
        
        return redirect()->back()->with('success', 'Total Cart Price: '$carts);

        ]);
    }

    public function getCartTotalWeight()
    {
        $carts = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('weight');
        
        return redirect()->back()->with('success', 'Total Cart Weight: '$carts);

    }

    public function removeCart($cart_id)
    {
        // Cart::with('course')
        //         ->whereId($request->cart_id)
        //         ->delete();
        Cart::findOrFail($cart_id)->delete();
        
        return redirect()->back()->with('success', 'Removed Item Cart');
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
