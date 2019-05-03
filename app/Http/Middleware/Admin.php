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
    public function handle($request, Closure $next)
    {
        /*If the user is authenticated*/
        if(Auth::check()){
            /*Check if the role of the user is admin or not*/
            if(Auth::user()->checkRole() == "Admin"){
                return $next($request);
            }

        }
        return redirect('404');
    }
}
