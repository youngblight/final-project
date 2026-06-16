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
        $request->authenticate();

        $request->session()->regenerate();

        // 1. Get the authenticated user
        $user = Auth::user();

        // 2. Custom Redirect Logic based on Role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } 
        
        if ($user->role === 'craftsmen') {
            // Optional: Check if they are approved before letting them in
            // if ($user->craftsmanProfile && $user->craftsmanProfile->status !== 'approved') {
            //     Auth::guard('web')->logout();
            //     return redirect()->route('login')->with('error', 'Your account is pending admin approval.');
            // }
            
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