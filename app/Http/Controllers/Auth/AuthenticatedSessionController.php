<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Jenssegers\Agent\Agent;

use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    private const LOGIN_ROUTE = 'login';
    private const JOB_PORTAL_LOGIN_ROUTE = 'job-portal.login';
    private const JOB_PORTAL_PROFILE_ROUTE = 'job-portal.profile.index';

    private const VALIDATION_ERROR_TOPIC = 'validation-error';

    private const ACCOUNT_SUSPENDED_ERROR_MESSAGE = 'Your account has been suspended!';
    private const USER_MUST_BE_HIRING_PARTNER_ERROR_MESSAGE = 'Please use the Job-Portal login page!';
    private const USER_MUST_NOT_BE_HIRING_PARTNER_ERROR_MESSAGE = 'Please use the normal login page!';

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $agent = new Agent();
        // if ($agent->isPhone())
        //     return view('client/mobile/under-construction');
            
        $transactions = null;
        $cart_count = 0;
        
        if($agent->isPhone())
            return view('client/mobile/auth/login', compact('cart_count','transactions'));

        return view('client/auth/login', compact('cart_count','transactions'));
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
        
        if (Auth::user()->status == 'suspended')
            return $this->logUserOutWithRouteAndTopicAndMessage($request, self::LOGIN_ROUTE, self::VALIDATION_ERROR_TOPIC,
                self::ACCOUNT_SUSPENDED_ERROR_MESSAGE);
        if (Auth::user()->userRole->id == '4')
        return $this->logUserOutWithRouteAndTopicAndMessage($request, self::LOGIN_ROUTE, self::VALIDATION_ERROR_TOPIC,
            self::USER_MUST_BE_HIRING_PARTNER_ERROR_MESSAGE);
            
        return $this->redirectUserBasedOnUserRole($request);
    }

    public function customLoginForHiringPartners(LoginRequest $request) {
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->status == 'suspended')
            return $this->logUserOutWithRouteAndTopicAndMessage($request, self::JOB_PORTAL_LOGIN_ROUTE, self::VALIDATION_ERROR_TOPIC,
                self::ACCOUNT_SUSPENDED_ERROR_MESSAGE);
        if (Auth::user()->userRole->id != '4')
            return $this->logUserOutWithRouteAndTopicAndMessage($request, self::JOB_PORTAL_LOGIN_ROUTE, self::VALIDATION_ERROR_TOPIC,
                self::USER_MUST_NOT_BE_HIRING_PARTNER_ERROR_MESSAGE);

        return $this->redirectUserBasedOnUserRole($request);
    }

    private function logUserOutWithRouteAndTopicAndMessage(LoginRequest $request, String $route, String $topic, String $message) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route($route)->with($topic, $message);
    }

    private function redirectUserBasedOnUserRole(LoginRequest $request) {
        $userRoleId = Auth::user()->userRole->id;
        // If user's role is "user"
        if ($userRoleId == 1) {
            // Redirect user based on users
            if ($request->has('url')) {
                return redirect($request->url);
            } else {
                return redirect()->route(self::LOGIN_ROUTE);
            }
        // If user's role is "hiring-partner"
        } else if ($userRoleId == 4) {
            return redirect()->route(self::JOB_PORTAL_PROFILE_ROUTE);
        }

        return redirect()->route('admin.dashboard.index');
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
}
