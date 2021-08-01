<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function __invoke(EmailVerificationRequest $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    // }

    // Custom method to handle email verification.
    function __invoke(Request $request) {
        $user = User::findOrFail($request->route('id'));

        // Checks if url's hash is valid.
        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification())))
            abort(403);

        if ($user->hasVerifiedEmail())
            return Auth::check() ?
                redirect()->intended(RouteServiceProvider::HOME.'?verified=1') :
                redirect()->route('login')->with('email-verification-success', $user->email);


        if ($user->markEmailAsVerified())
            event(new Verified($user));

        return Auth::check() ?
            redirect()->intended(RouteServiceProvider::HOME.'?verified=1') :
            redirect()->route('login')->with('email-verification-success', $user->email);
    }
}
