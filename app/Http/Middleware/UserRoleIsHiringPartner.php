<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserRoleIsHiringPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $this->isUserAdmin() || $this->isUserHiringPartner() ?
            $next($request) : abort(403);
    }

    private function isUserAdmin() {
        return Auth::user()->userRole->role_name == 'admin' || 
            Auth::user()->userRole->role_name == 'super-admin';
    }

    private function isUserHiringPartner() {
        return Auth::user()->userRole->role_name == 'hiring-partner';
    }
}
