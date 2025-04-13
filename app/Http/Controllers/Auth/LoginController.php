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
<<<<<<< HEAD
            dd($user);
           
=======
            if ($user->FK_ID_vai_tro ==1 || $user->FK_ID_vai_tro == 3) {
                return redirect()->route('admin.quanly');
            } else return redirect()->route('trangchu');
            
>>>>>>> 9fbf7df49ca4c6737dadcccc82b750f3db3b2453
        }
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ]);
    }
}
