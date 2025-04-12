<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $id = Auth::user()->FK_ID_vai_tro;
        if (!Auth::check()||$id !=$role) {
            return redirect()->route("admin.quanly")-> with("error","Bạn không có quyền truy cập vào trang này!");
        }
        return $next($request);
    }
}
