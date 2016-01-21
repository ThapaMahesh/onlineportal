<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Adminmid
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
        if(Auth::user()->role->permission == 25){
            $img = Auth::user()->profile->image;
            if($img == ""){
                $img = asset('asset/img/avatar.jpg');
            }else{
                $img = asset('asset/userimage/'.Auth::user()->profile->image);
            }
            Auth::user()->profile->image = $img;
            view()->share('auth', Auth::user());
            return $next($request);
        }
        return redirect('auth/login');
    }
}
