<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->status=='Active')
        {
            if(Auth::guard('admin')->user()->superAdmin=='Y')
            {
                return $next($request);    
            }
            return redirect('/admin');
        }
        return redirect('/');
    }
}
