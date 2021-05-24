<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.login');
        if(Auth::check()) {
            $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();
            $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return view('client/auth/login',compact('cart_count','transactions'));
            
        }
        else{
            $transactions=null;
            $cart_count=0;
            return view('client/auth/login',compact('cart_count','transactions'));
        }
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {   
        $request->authenticate();

        $request->session()->regenerate();
        
        $this->ifUserSuspended($request);

        // Redirect based on user's role.
        if (Auth::user()->userRole->id == 1) {
            return redirect()->route('index');
        } else {
            return redirect()->route('admin.dashboard.index');
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Log user if he/she is suspended.
    private function ifUserSuspended(Request $request) { 
        if (Auth::user()->status == 'suspended') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('message', 'Your account has been suspended!');
        }
    }
}
