<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update(['last_login' => now()]);

            // Redirect berdasarkan role
            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->hasRole('finance')) {
                return redirect()->intended(route('finance.kas'));
            } elseif ($user->hasRole('gudang')) {
                return redirect()->intended(route('gudang.barang'));
            } elseif ($user->hasRole('kasir')) {
                return redirect()->intended(route('kasir.transaksi'));
            }

            // Fallback jika role tidak dikenali
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali.')->withInput();
        }

        return back()->with('error', 'Email atau password salah.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}