<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBlocked
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_blocked) {
            
            // Log out mtumiaji
            Auth::logout();

            // Batilisha session na tengeneza token mpya
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Rudi kwenye ukurasa wa login ukiwa na error message
            return redirect()->route('login')->with('error', 'Akaunti yako imefungwa (Blocked) na Admin.');
        }

        return $next($request);
    }
}