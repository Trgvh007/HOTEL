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
    
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $id = Auth::user()->FK_ID_vai_tro;

        // Xử lý nhiều role, ví dụ: '1|3'
        $allowedRoles = explode('|', $role);
        if (!in_array($id, $allowedRoles)) {
          
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này!');
        }

        return $next($request);
    }
}
