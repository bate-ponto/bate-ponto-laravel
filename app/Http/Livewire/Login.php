<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\{Component, Redirector};

class Login extends Component
{
    public ?string $username = null;

    public ?string $password = null;

    public bool $rememberMe = false;

    protected $rules = [
        'username'   => ['required', 'string'],
        'password'   => ['required', 'string', 'min:8'],
        'rememberMe' => ['bool'],
    ];

    public function submit()
    {
        $this->validate();

        $field = filter_var($this->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credentials = [
            $field     => $this->username,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->rememberMe)) {
            session()->regenerate();

            return redirect()->route('index');
        }

        $this->addError(
            'username',
            'The provided credentials do not match our records.'
        );
    }

    public function render(): View
    {
        return view('livewire.login');
    }
}
