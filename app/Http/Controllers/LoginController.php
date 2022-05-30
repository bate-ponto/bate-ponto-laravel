<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function loginForm (): View
    {
        return view('login');
    }

    public function registerForm (): View
    {
        return view('register');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->intended('index');
        }

        return back()->with([
            'email' => 'The provided credentials do not match our records.'
        ])
        ->onlyInput('email');
    }

    public function register(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name'                  => ['required', 'string', 'min:3'],
            'email'                 => ['required', 'email'],
            'password'              => ['required', 'string', 'min:8'],
            'password-confirmation' => ['required_with:password', 'string', 'same:password'],
        ]);

        User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
        ]);

        return $this->authenticate($request);
    }

    public function logout(): Redirector|RedirectResponse
    {
        Auth::logout();
 
        session()->invalidate();
    
        session()->regenerateToken();
    
        return redirect('/');
    }
}
