<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\Hashtag;
use App\Models\Cart;
use App\Models\Province;
use App\Models\City;
use App\Models\Order;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserDetail;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        $cities = City::all();
        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
        $transactions = Notification::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0],
                
            ]
            )->orderBy('created_at', 'desc')->get();
        
        $orders = Order::whereHas('invoice', function ($query){
            $query->where(
                [
                    ['status', '=', 'paid'],
                    ['user_id', '=', auth()->user()->id],
                ]
            );
                })->orderBy('orders.created_at', 'desc')->get();

        $interests = Hashtag::all();
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();


        return view('client/user-dashboard', compact('provinces','cities','cart_count','transactions','orders','interests','informations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request, $id)
    {
        $input = $request->all();
        $validated = $request->validate([
            'name'          => 'required',
            'telephone'     => 'required',
            'birthdate'     => 'date',
            //'avatar'        => 'mimes:jpeg,jpg,png',

        ]);

        //

        $user = User::findOrFail($id);
        $user->name                 = $validated['name'];
        //$user->avatar               = Helper::storeImage($request->file('avatar'), 'storage/images/users/');
        $user->save();

        $user_detail                = UserDetail::findOrFail($user->userDetail->id);
        $user_detail->telephone     = $validated['telephone'];
        $user_detail->birthdate     = $input['birthdate'];
        $user_detail->gender        = $input['gender'];
        $user_detail->address       = $input['address'];
        $user_detail->company       = $input['company'];
        $user_detail->occupancy     = $input['occupancy'];
        $user_detail->province_id   = $input['province'];
        $user_detail->city_id       = $input['city'];
        $user_detail->save();

        return redirect('/dashboard#edit-profile')->with('success', 'Update Profile Berhasil!');
    }

    public function update_interest(Request $request, $id)
    {

        $validated = $request->validate([
            'interests' => 'required|array',
        ]);
       
        //here store to user and user detail table

        $hashtag_ids= [];
        foreach($validated['interests'] as $hashtag_id => $flag)
        {
            if($flag == '1') 
                $hashtag_ids[] = $hashtag_id;
        }

        if(count($hashtag_ids) > 3)
            return redirect()->back()->with('message','');
        
        $user = User::findOrFail($id);
        $user->hashtags()->attach($hashtag_ids);


        return redirect('/dashboard#my-interests')->with('success', 'Update Profile Berhasil!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
