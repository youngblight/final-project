<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CraftsmenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kagua kama mtumiaji ameingia (Auth::check)
        // 2. Kagua kama 'role' ya mtumiaji ni 'craftsmen'
        if (!Auth::check() || Auth::user()->role !== 'craftsmen') {
            
            // Ikiwa siyo craftsmen, mrudishe nyumbani
            return redirect('/')
                ->with('error', 'Huna ruhusa! Ukurasa huu ni kwa ajili ya Mafundi tu.');
        }

        // Ikiwa ni craftsmen, mruhusu aendelee
        return $next($request);
    }
}