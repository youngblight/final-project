<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)          
                    ->letters()       
                    ->mixedCase()         
                    ->numbers()           
                    ->symbols()           
                    ->uncompromised(),
            ],
        ], [
            // Ujumbe wa usaidizi kwa Kiswahili
            'name.required' => 'Tafadhali weka jina lako.',
            'email.required' => 'Tafadhali weka barua pepe (email) yako.',
            'email.unique' => 'Barua pepe hii tayari imeshasajiliwa.',
            'password.required' => 'Tafadhali weka nenosiri (password).',
            'password.confirmed' => 'Nenosiri ulilorudia halifanani na la kwanza.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Mpeleke mteja kwenye homepage baada ya usajili
        return redirect()->route('home.page');
    }
}