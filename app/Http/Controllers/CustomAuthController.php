<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Jenssegers\Agent\Agent;
use Axiom\Rules\StrongPassword;
use Throwable;

use App\Models\User;
use App\Models\Review;
use App\Models\UserDetail;
use App\Models\Hashtag;
use App\Models\ReferralCodeCounter;
use App\Mail\ForgetPasswordMail;

/*
|--------------------------------------------------------------------------
| CustomAuthController Class.
|
| Description:
| This controller is responsible in handling custom authentication method. 
|--------------------------------------------------------------------------
*/ 
class CustomAuthController extends Controller
{
    // Shows the Signup General Info Page.
    public function signUpGeneralInfoIndex() {
        $agent = new Agent();
        if ($agent->isPhone())
            return view('client/mobile/under-construction');

        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/auth/signup', compact('footer_reviews'));
    }

    // Stores User's General Info data in session.
    public function storeGeneralInfo(Request $request) {
        $validation_rules = [
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:users',
            'response' => 'required',
            'referral_code' => '',
        ];

        // Use StrongPassword validation on production.
        if (App::environment('production'))
            $validation_rules['password'] = ['required', new StrongPassword];
        else
            $validation_rules['password'] = ['required'];

        $validated = $request->validate($validation_rules);

        $request->session()->put('name', $validated['name']);
        $request->session()->put('telephone', $validated['telephone']);
        $request->session()->put('email', $validated['email']);
        $request->session()->put('password', $validated['password']);
        $request->session()->put('response', $validated['response']);

        if($validated['referral_code']) {
            $referralCodes = UserDetail::select('referral_code')->get()->pluck('referral_code')->toArray();
            if (!in_array($validated['referral_code'], $referralCodes)){
                return redirect()->route('custom-auth.signup_general_info.index')
                    ->withErrors(['referral_code' => 'Referral Code tidak ditemukan!']);
            }
            $request->session()->put('referral_code', $validated['referral_code']);
        }

        return redirect()->route('custom-auth.signup_interest.index');
    }

    // Shows the Signup Interest Page.
    public function signUpInterestIndex(Request $request) {
        $agent = new Agent();
        if ($agent->isPhone())
            return view('client/mobile/under-construction');
        
        if (!$request->session()->get('name') || !$request->session()->get('telephone') || !$request->session()->get('email') || 
            !$request->session()->get('password') || !$request->session()->get('response'))
            return redirect()->route('custom-auth.signup_general_info.index');

        $interests = Hashtag::all();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/auth/signup-interests', compact('interests','footer_reviews'));
    }

    // Store new user data in the database.
    public function storeNewUser(Request $request) {
        $validated = $request->validate([
            'interests' => 'required|array'
        ]);

        // Check if General Info data exists in sesion.
        if (!$request->session()->get('name') || !$request->session()->get('telephone') || !$request->session()->get('email') || 
            !$request->session()->get('password') || !$request->session()->get('response'))
            return redirect()->route('custom-auth.signup_general_info.index');

        $hashtag_ids= [];
        foreach ($validated['interests'] as $hashtag_id => $flag) {
            if($flag == '1') 
                $hashtag_ids[] = $hashtag_id;
        }

        if(count($hashtag_ids) > 3)
            return redirect()->back()->with('message', 'message');

        $user = User::create([
            'name'      => $request->session()->get('name'),
            'email'     => $request->session()->get('email'),
            'password'  => Hash::make($request->session()->get('password'))
        ]);

        // Generate New Referral Code
        $newReferralCode = $this->generateUniqueReferralCode();

        $referredByCode = $request->session()->get('referral_code') ?
            $request->session()->get('referral_code') : null;
            
        $user_detail = UserDetail::create([
            'user_id'               => $user->id,
            'telephone'             => $request->session()->get('telephone'),
            'referral_code'         => $newReferralCode,
            'referred_by_code'      => $referredByCode,
            'response'              => $request->session()->get('response')
        ]);

        // here store to user_hashtag table
        $user->hashtags()->attach($hashtag_ids);
    
        $request->session()->flush();
        
        event(new Registered($user));
        
        Auth::login($user);

        return redirect()->route('customer.dashboard');
    }

    // Method to generate a random new referral code.
    private function generateUniqueReferralCode() {
        $referralCodes = UserDetail::select('referral_code')->get()->pluck('referral_code')->toArray();
        // $first_name = strtoupper(substr($name, 0, 3));
        
        $newReferralCode = strtoupper(Str::random(5));
        while (in_array($newReferralCode, $referralCodes)) {
            $newReferralCode = strtoupper(Str::random(5));
        }
        return $newReferralCode;
    }

    // Handles the forgot-password (reset) functionality in the login page.
    public function resetPassword(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user)
            return redirect(route('login') . '#forget-password')->with('danger', 'Oops, email does not exists.');

        $currentPasswordHashed = $user->password;
        $newPassword = $this->generateRandomString(12);
        $user->password = Hash::make($newPassword);
        $user->save();

        if ($user->wasChanged()) {
            $messageTopic = 'success';
            $message = 'A new password has successfully been generated for your account, please check your email for further informations!';
            try {
                Mail::to($user->email)->send(new ForgetPasswordMail($newPassword));
            } catch (Throwable $e) {
                $user->password = $currentPasswordHashed;
                $user->save();
                $messageTopic = 'danger';
                $message = 'Oops, unable to send email. Your old password has been kept.';
                if (!App::environment('production'))
                    $message = $e->getMessage();
            }
        } else {
            $messageTopic = 'danger';
            $message = 'Oops, unable to update your password.';
        }

        return redirect(route('login') . '#forget-password')->with($messageTopic, $message);
    }

    // Method to generate a random password of length (input).
    private function generateRandomString($length) {
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}
