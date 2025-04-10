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
  

    public function handle(Request $request, Closure $next, $roleId = null)
    {
    

        if (Auth::check()) {
            $user = Auth::user();

            
            // Kiểm tra vai trò của user
            if (in_array($user->id_role, [1, 3])){
                return $next($request);
                \Log::info('Role của user: ' . Auth::user()->id_role);

            }
        }

        // Nếu không có quyền, chuyển về trang chủ
        return redirect()->route('trangchu');
    }
}
