<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Hakikisha email na password ni sahihi
        $request->authenticate();

        $user = Auth::user();

        // 2. ANGALIA KAMA MTUMIAJI AMEBLOKIWA (IS_BLOCKED)
        if ($user->is_blocked) {
            // Mtoe nje mara moja
            Auth::guard('web')->logout();

            // Batilisha session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Mtoe nje na ujumbe wa kosa
            return redirect()->route('login')->with('error', 'Akaunti yako imefungwa (Blocked) na Admin. Tafadhali wasiliana na msaada.');
        }

        // 3. Kama hajablokiwa, regeneratets session
        $request->session()->regenerate();

        // 4. Custom Redirect Logic based on Role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } 
        
        if ($user->role === 'craftsmen') {
            return redirect()->intended(route('craftsmen.dashboard'));
        }

        // Default redirect for regular users/customers
        return redirect()->intended(route('home.page', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}