<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest())
        {
                return redirect()->guest('/')->with('error','you must log in first.');
        }

        if(Auth::check() && Auth::user()->role != 1){
            Auth::logout();
            return redirect()->to('/')->with('error','you must log in as website owner');
        }
//        if (Auth::check() && Auth::user()->role == 1) {
//            return redirect('/olx/dashboard'); // this is the route that you are sent to if you're already logged in and try to access the /login route
//        }


        return $next($request);
    }
}
