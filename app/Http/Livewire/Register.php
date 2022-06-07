<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\View\View;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $username = '';

    public string $password = '';

    public string $passwordConfirmation = '';

    protected $rules = [
        'name'                 => ['required', 'string', 'min:3'],
        'email'                => ['required', 'email', 'unique:users,email'],
        'username'             => ['required', 'string', 'min:4', 'unique:users,username'],
        'password'             => ['required', 'string', 'min:8'],
        'passwordConfirmation' => ['required', 'same:password'],
    ];

    public function submit()
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        Auth::attempt([
            'username' => $this->username,
            'password' => $this->password,
        ]);

        session()->regenerate();

        return redirect()->route('index');
    }

    public function render(): View
    {
        return view('livewire.register');
    }
}
