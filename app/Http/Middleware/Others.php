<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Others
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
        if(Auth::user()->role->permission == 15 || Auth::user()->role->permission == 5){
            view()->share('auth', Auth::user());
            return $next($request);
        }
        return redirect('auth/login');
    }
}
