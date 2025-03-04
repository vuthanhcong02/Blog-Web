<?php

namespace App\Http\Middleware\Client;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Kiểm tra xem người dùng đã đăng nhập hay chưa : Chưa đăng nhập =>true
        if(Auth::guest()){
            return redirect()->guest('/account/login');
        }
        return $next($request);
    }
}
