<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProveriStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Admin uvek moze
            if ($user->uloga === 'administrator') {
                return $next($request);
            }

            // Na cekanju
            if ($user->status === 'na_cekanju') {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('status_poruka', 'na_cekanju');
            }

            // Odbijen
            if ($user->status === 'odbijen') {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('status_poruka', 'odbijen');
            }

            // Deaktiviran
            if (!$user->aktivan) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('status_poruka', 'deaktiviran');
            }

            // Email nije verifikovan
            if (!$user->email_verified_at) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('status_poruka', 'nije_verifikovan');
            }
        }

        return $next($request);
    }
}