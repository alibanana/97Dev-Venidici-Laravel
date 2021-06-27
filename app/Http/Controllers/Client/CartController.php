<?php

namespace App\Http\Controllers\Client;
use Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Helper\Helper;

use App\Models\Cart;
use App\Models\Province;
use App\Models\City;
use App\Models\Invoice;
use App\Models\Promotion;   
use App\Models\Course;   
use App\Models\Notification;
use Jenssegers\Agent\Agent;

class CartController extends Controller
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

    // Shows the client cart page. (/cart)
    public function index() {
        Helper::mobileViewNotReady();

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;
        
        $carts = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $noWoki = true; $total_price = 0;
        foreach ($carts as $cart) {
            if($cart->course->course_type_id == 2)
                $noWoki = false;
            // If cart withArtOrNo (true) -> store priceWithArtKit data. Else store normal price data.
            $tempPriceOnly = $cart->withArtOrNo ? $cart->course->priceWithArtKit : $cart->course->price;
            $total_price += $cart->quantity * $tempPriceOnly;
        }

        return view('client/cart',
            compact('notifications', 'informations', 'transactions', 'cart_count', 'carts', 'noWoki', 'total_price'));
    }
    
    // Shows the client payment shipping page. (/payment)
    public function shipment_index(Request $request) {
        Helper::mobileViewNotReady();

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;
        
        if (!auth()->user()->isProfileUpdated)
            return redirect()->back()->with('message','Please complete your profile first.');
        elseif (count(auth()->user()->carts) == 0)
            return redirect('/cart');

        $carts = auth()->user()->carts;

        $tomorrow = Carbon::now()->addDays(1);
        $tomorrow->setTimezone('Asia/Jakarta');

        $total_price = 0; $sub_total = 0; $shipping_cost = 0; $tipe_pengiriman = null;

        // Calculate sub-total.
        foreach($carts as $cart) {
            $sub_total_price = $cart->withArtOrNo ? $cart->course->priceWithArtKit : $cart->course->price;
            $sub_total += $cart->quantity * $sub_total_price;
        }
        
        $provinces = Province::all();

        if ($request->has('province')) {
            $province_id = $request['province'];
            $cities = City::where('province_id', $province_id)->get();
        } else{
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
            foreach ($tipe_pengiriman as $tipe) {
                if($tipe['service'] == $nama_tipe)
                    $shipping_cost = $tipe['cost'][0]['value'];
            }
        }

        $total_price = $sub_total + $shipping_cost;

        $noWoki = true;
        foreach ($carts as $cart) {
            if($cart->withArtOrNo) $noWoki = false;
        }

        return view('client/cart-shipping',
            compact('notifications', 'informations', 'transactions', 'cart_count', 'carts', 'provinces',
                'cities', 'sub_total', 'shipping_cost', 'tipe_pengiriman', 'total_price', 'tomorrow', 'noWoki'));
    }

    // Add item to cart (in the database).
    public function store(Request $request) {
        $validated = $request->validate([
            'course_id' => 'required|integer',
            'withArtOrNo' => 'required|integer'
        ]);

        // Get cart data 
        $cart_object = auth()->user()->carts()
            ->where('course_id', $validated['course_id'])
            ->where('withArtOrNo', $validated['withArtOrNo'])->first();

        // Whne withArtOrNo equal either 0 or 1. Handle if each cases is available on the user's cart already.
        if ($cart_object != null) {
            if ($validated['withArtOrNo']) {
                $cart_object->quantity += 1;
                $cart_object->price = $cart_object->course->priceWithArtKit * $cart_object->quantity;
                $cart_object->save();
                $request->session()->put('cart_count', $request->session()->get('cart_count') + 1); 
                if ($request->action != 'buyNow')
                    return redirect()->back()->with('success', 'Product added to cart successfully!');
                else
                    return redirect()->route('customer.cart.index');
            } else {
                if ($request->action != 'buyNow')
                    return redirect()->back()->with('success', 'Item sudah ada di cart');
                else
                    return redirect()->route('customer.cart.index');
            }
        }

        // Course given is not in the user's cart yet.
        $course = Course::findOrFail($validated['course_id']);
        $newCartData = [
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
            'withArtOrNo'   => $validated['withArtOrNo']
        ];
        if ($validated['withArtOrNo'])
            $newCartData['price'] = $course->priceWithArtKit;
        else
            $newCartData['price'] = $course->price;

        $item = Cart::create($newCartData);

        $request->session()->put('cart_count', $request->session()->get('cart_count') + 1); 

        // If request action is buyNow.
        if ($request->action == 'buyNow')
            return redirect()->route('customer.cart.index');

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function getCartTotal() {
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

    // Increase the quantity of a cart object.
    public function increaseQty(Request $request) {
        $cart = Cart::where('id', $request->cart_id)->where('withArtOrNo', true)->firstOrFail();
        
        $currentCoursePrice = $cart->course->priceWithArtKit;

        // Update and save new quantity & price.
        $cart->quantity += 1;
        $cart->price = $cart->quantity * $currentCoursePrice;
        $cart->save();

        // Save new cart_count in session.
        $request->session()->put('cart_count', $request->session()->get('cart_count') + 1);  

        return redirect()->back();
    }

    // Decrease the quantity of a cart object.
    public function decreaseQty(Request $request) {
        $cart = Cart::where('id', $request->cart_id)->where('withArtOrNo', true)->firstOrFail();

        // Skip process if quantity is 1 already.
        if ($cart->quantity == 1) return redirect()->back();

        // Get latest course price data.
        $currentCoursePrice = $cart->course->priceWithArtKit;

        // Update and save new quantity & price.
        $cart->quantity -= 1;
        $cart->price = $cart->quantity * $currentCoursePrice;
        $cart->save();

        $request->session()->put('cart_count', $request->session()->get('cart_count') - 1);  

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
