<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Axiom\Rules\StrongPassword;
use App\Helper\Helper;

use App\Models\Hashtag;
use App\Models\Cart;
use App\Models\Province;
use App\Models\City;
use App\Models\Order;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserDetail;

use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // Shows the client User Dashboard page.
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
                ],
            )->orWhere(
                [
                    ['status', '=', 'completed'],
                    ['user_id', '=', auth()->user()->id],
                ],
            );
                })->orderBy('orders.created_at', 'desc')->get();

        $interests = Hashtag::all();
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();


        return view('client/user-dashboard', compact('provinces','cities','cart_count','transactions','orders','interests','informations'));
    }

    // Updates Users's data in the database.
    public function update_profile(Request $request, $id)
    {
        $input = $request->all();
        $validated = Validator::make($input,[
            'name'          => 'required',
            'telephone'     => 'required',
            'birthdate'     => 'date',
        ]);

        if($validated->fails()) 
            return redirect('/dashboard#edit-profile')->withErrors($validated);
        else 
            $validated = $validated->validate();
        

        $user = User::findOrFail($id);
        $user->name = $validated['name'];

        if ($request->has('avatar')) {
            if($user->avatar)
                unlink($user->avatar);
            $user->avatar = Helper::storeImage($request->file('avatar'), 'storage/images/users/');
        }

        $user->save();

        $user_detail = $user->userDetail;
        $user_detail->update($request->except([
            'name','telephone'
        ]));

        return redirect('/dashboard#edit-profile')->with('success', 'Update Profile Berhasil!');
    }

    public function update_interest(Request $request)
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
            return redirect('/dashboard#my-interests')->with('message','testing');
        
        auth()->user()->hashtags()->sync($hashtag_ids);

        return redirect('/dashboard#my-interests')->with('success', 'Update Profile Berhasil!');
    }

    // Changes the user's password in the database.
    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => ['required', 'confirmed', new StrongPassword]
        ]);

        if ($validator->fails()) {
            return redirect(route('customer.dashboard') . '#change-password')
                ->withErrors($validator);
        }

        $validated = $request->only(['old_password', 'password']);
        $user = auth()->user();

        // Check if old password matches.
        if (!Hash::check($validated['old_password'], $user->password)) {
            return redirect(route('customer.dashboard') . '#change-password')
                ->withErrors([
                    'old_password' => 'Current password does not matched..'
                ]);
        }

        // Check if new password is the same with old password.
        if (Hash::check($validated['password'], $user->password)) {
            return redirect(route('customer.dashboard') . '#change-password')
                ->withErrors([
                    'password' => 'New password cannot be the same..'
                ]);
        }

        $user->password =  Hash::make($validated['password']);
        $user->save();

        if ($user->wasChanged()) {
            $message = 'Your password has been changed.';
        } else {
            $message = 'Seems like something went wrong..';
        }

        return redirect(route('customer.dashboard') . '#change-password')->with('success', $message);
    }
}
