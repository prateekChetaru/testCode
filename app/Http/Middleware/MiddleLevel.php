<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class MiddleLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('client')->check() && Auth::guard('client')->user()->status=='Active')
        {
            if((Auth::guard('client')->user()->roleId==1) || (Auth::guard('client')->user()->roleId==2))
            {
                return $next($request);
            }
            return redirect('/');
        }
        return redirect('/');
    }
}
