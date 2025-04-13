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
  

    public function handle(Request $request, Closure $next)
    {
    

        if (Auth::check()) {
            $user = Auth::user();
         
    
            // Kiểm tra vai trò của user
            if ($user->id_role == 3) {
                return $next($request);
            }
            // Nếu không có quyền, chuyển về trang chủ
            return redirect()->route('home');
        }

        
    }
}
