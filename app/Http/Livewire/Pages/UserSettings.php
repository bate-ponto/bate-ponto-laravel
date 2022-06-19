<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;

class UserSettings extends Component
{
    public User $user;

    public string $password = '';

    public string $passwordConfirmation = '';

    protected array $validationAttributes = [
        'user.name'            => 'name',
        'user.username'        => 'username',
        'user.email'           => 'email',
        'password'             => 'password',
        'passwordConfirmation' => 'password confirmation',
    ];

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function submit(): void
    {
        $this->resetValidation();

        $this->validate();

        if ($this->password && $this->passwordConfirmation) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->save();
    }

    protected function rules(): array
    {
        return [
            'user.name'            => ['required', 'string', 'min:3'],
            'user.username'        => ['required', 'string', 'min:4', "unique:users,username,{$this->user->id}"],
            'user.email'           => ['required', 'email', "unique:users,email,{$this->user->id}"],
            'password'             => ['nullable', 'string', 'min:8'],
            'passwordConfirmation' => ["required_with:password", 'same:password'],
        ];
    }

    public function render(): View
    {
        return view('livewire.pages.user-settings');
    }
}
