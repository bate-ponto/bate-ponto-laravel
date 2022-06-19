<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldRenderRegisterComponent(): void
    {
        Livewire::test(Register::class)
            ->assertViewIs('livewire.register');
    }

    public function testCannotRegisterWithoutInputFields(): void
    {
        Livewire::test(Register::class)
            ->call('submit')
            ->assertHasErrors([
                'name'                 => 'required',
                'email'                => 'required',
                'username'             => 'required',
                'password'             => 'required',
                'passwordConfirmation' => 'required',
            ]);
    }

    public function testCanRegisterWithValidInputFields(): void
    {
        Livewire::test(Register::class)
            ->set('name', 'Gabriel Ramos')
            ->set('email', 'gabriel.ramos@test.com')
            ->set('username', 'gabriel.ramos')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect(route('index'));
    }
}
