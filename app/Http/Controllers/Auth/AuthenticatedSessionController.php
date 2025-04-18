<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->FK_ID_vai_tro ==1 || $user->FK_ID_vai_tro == 3) {
            return redirect()->route('admin.quanly');
        } else return redirect()->route('home');

        //return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
{
    if ($user->level == User::ROLE_ADMIN) {
        return redirect()->route('quanly.php'); // Đường dẫn đến dashboard của quản lý
    } elseif ($user->level == User::ROLE_USER) {
        return redirect()->route('dashboard'); // Đường dẫn đến dashboard của khách hàng
    } 
}
}
