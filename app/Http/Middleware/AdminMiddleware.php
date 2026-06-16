<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // 2. Kagua kama 'role' ya mtumiaji aliyelogin ni 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            
            // Ikiwa siyo admin, mrudishe kwenye ukurasa wa nyumbani (home)
            // na umtumie ujumbe wa onyo (flash message)
            return redirect('/')
                ->with('error', 'Huna ruhusa ya kuingia hapa (Admin Only).');
        }

        // Ikiwa ni admin, mruhusu aendelee kwenye route anayotafuta
        return $next($request);
    }
}