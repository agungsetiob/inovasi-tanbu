<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\Setting;
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
        $setting = Setting::latest()->value('logo_cover');
        return view('auth.login', compact('setting'));
    }

    public function createRiset()
    {
        $setting = Setting::latest()->value('logo_cover');
        return view('auth.login-riset', compact('setting'));
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
        if (Auth::user()->status != 'active') {

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return back()->with('fail', 'Akun anda tidak aktif, hubungi admin untuk aktivasi');
        }
        if (Auth::user()->role === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        
    }

    public function storeRiset(LoginRequest $request)
    {

        $request->authenticate();
        $request->session()->regenerate();
        if (Auth::user()->status != 'active') {

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return back()->with('fail', 'Akun anda tidak aktif, hubungi admin untuk aktivasi');
        }
        if (Auth::user()->role === 'admin') {
            return redirect('/dashboard/riset');
        } else {
            return redirect('/dashboard/user/riset');
        }
        
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
}
