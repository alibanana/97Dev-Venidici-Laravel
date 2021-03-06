<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use \Illuminate\Http\Request;

class SocialController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $response = $this->_registerOrLoginUser($request, $user);
        if($response == 'Not Yet Registered')
            return redirect('/signup');

        // Return home after login
        return redirect('/dashboard');
    }
    protected function _registerOrLoginUser(Request $request, $data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            //return redirect()->route('signup_general_info');

            //$referralCodes = UserDetail::select('referral_code')->get()->pluck('referral_code')->toArray();
            //$user = new User();
            //$user->name = $data->name;
            //$user->email = $data->email;
            //$user->provider_id = $data->id;
            //$user->password = encrypt('password');
            //$user->save();

            // Generate New Referral Code
            //$newReferralCode = substr($data->name, 0,3).Str::random(3);

            // selama referralnya belom ada
            //while (in_array($newReferralCode, $referralCodes)) {
                //buat referral baru
                //$newReferralCode = substr($data->name, 0,3).Str::random(3);
            //}


            //$user_detail = new UserDetail();
            //$user_detail->user_id = $user->id;
            //$user_detail->referral_code = strtoupper($newReferralCode);
            //$user_detail->save();
            $request->session()->put('name', $data->name);
            $request->session()->put('email', $data->email);
            $response = 'Not Yet Registered';
            return $response;
        }
        Auth::login($user);
        $response = 'Has Registered';
        return $response;

    }
}