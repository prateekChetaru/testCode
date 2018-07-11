<?php

namespace App\Http\Middleware;

use Closure;

class LowerLevel
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
            if(Auth::guard('client')->user()->roleId==3)
            {
                return $next($request);
            }
            return redirect('/');
        }
        return redirect('/');
    }
}
