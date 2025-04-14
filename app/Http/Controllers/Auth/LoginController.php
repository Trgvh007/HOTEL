<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;






class LoginController extends Controller
{
   
    public function getLogin()
    {
        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Ngăn chặn CSRf

      

          
            if (in_array($user->id_role, [1, 3])){
                return redirect()->route('admin.quanly');
            } else {
                return redirect()->route('home');
            }

        }
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ]);
    }
}
