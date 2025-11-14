<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                
                // Redirect berdasarkan role
                if ($user->hasRole('admin')) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->hasRole('finance')) {
                    return redirect()->route('finance.kas');
                } elseif ($user->hasRole('gudang')) {
                    return redirect()->route('gudang.barang');
                } elseif ($user->hasRole('kasir')) {
                    return redirect()->route('kasir.transaksi');
                }
                
                // Fallback ke login kalau role ga dikenali
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}