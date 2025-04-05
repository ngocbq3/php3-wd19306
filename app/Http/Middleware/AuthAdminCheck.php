<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if ( !in_array(Auth::user()->role, $roles) ) {
            // Nếu không phải admin, chuyển hướng đến trang chủ hoặc trang khác
            return abort(403, 'Bạn không có quyền truy cập.');
        }
        return $next($request);
    }
}
