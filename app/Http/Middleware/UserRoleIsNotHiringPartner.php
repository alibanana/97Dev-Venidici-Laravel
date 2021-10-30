<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserRoleIsNotHiringPartner
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
        return $this->isUserNotHiringPartner() ?
            $next($request) : abort(403);
    }

    private function isUserNotHiringPartner() {
        return Auth::user()->userRole->role_name != 'hiring-partner';
    }
}
