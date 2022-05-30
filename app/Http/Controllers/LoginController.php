<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function loginForm (): View
    {
        return view('login');
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

    public function logout(): Redirector|RedirectResponse
    {
        Auth::logout();
 
        session()->invalidate();
    
        session()->regenerateToken();
    
        return redirect('/');
    }
}
