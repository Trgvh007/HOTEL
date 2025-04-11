<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Admin;


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
            $request->session()->regenerate(); // Ngăn chặn CSRF
            $user = Auth::user();
            dd($user);
            
            if ($user->id_role ==3){
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
