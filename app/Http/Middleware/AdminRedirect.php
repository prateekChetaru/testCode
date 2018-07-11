<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard ='web')
    {
        if(Auth::guard($guard)->check() && Auth::guard($guard)->user()->status=='Active' )
        {
            return $next($request);
        }
        return redirect('/admin');
    }
}
