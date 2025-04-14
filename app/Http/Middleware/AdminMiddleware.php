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

  

<<<<<<< HEAD
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
=======
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
>>>>>>> Cus_Booking_RoomDetail_Filter(Ad)
    }
}
