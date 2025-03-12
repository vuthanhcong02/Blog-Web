<?php

namespace App\Http\Middleware\Admin;

use App\Utilities\Constants;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest()) {
            return redirect()->route('admin.login');
        }
        if (Auth::user()->role != Constants::USER_LEVEL_ADMIN && Auth::user()->role != Constants::USER_LEVEL_MANAGER) {
            Auth::logout();
            toastr()->timeOut(2000)
                ->addError('Bạn không có quyền truy cập vào trang này');

            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
