<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
  

=======
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
>>>>>>> 4efa7656f50b0382d668908b393f5f27623055d7
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
<<<<<<< HEAD
         
    
            // Kiểm tra vai trò của user
            if ($user->id_role == 3) {
=======

            // Ghi log để kiểm tra vai trò
            Log::info('Role của user: ' . $user->id_role);

            // Kiểm tra nếu role là admin (id_role = 1 hoặc 3)
            if (in_array($user->id_role, [1, 3])) {
>>>>>>> 4efa7656f50b0382d668908b393f5f27623055d7
                return $next($request);
            }
            // Nếu không có quyền, chuyển về trang chủ
            return redirect()->route('home');
        }

<<<<<<< HEAD
        
=======
        // Không có quyền → chuyển hướng
        return redirect('/')->withErrors('Bạn không có quyền truy cập.');

>>>>>>> 4efa7656f50b0382d668908b393f5f27623055d7
    }
}
