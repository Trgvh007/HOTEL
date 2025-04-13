<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Ghi log để kiểm tra vai trò
            Log::info('Role của user: ' . $user->id_role);

            // Kiểm tra nếu role là admin (id_role = 1 hoặc 3)
            if (in_array($user->id_role, [1, 3])) {
                return $next($request);
            }
        }

        // Không có quyền → chuyển hướng
        return redirect('/')->withErrors('Bạn không có quyền truy cập.');

    }
}
