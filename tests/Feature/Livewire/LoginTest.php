<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldRenderLoginComponent(): void
    {
        Livewire::test(Login::class)
            ->assertViewIs('livewire.login');
    }

    public function testCannotLoginWithoutInputFields(): void
    {
        Livewire::test(Login::class)
            ->call('submit')
            ->assertHasErrors([
                'username' => 'required',
                'password' => 'required',
            ]);
    }

    public function testCannotLoginWithNoValidCredentials(): void
    {
        Livewire::test(Login::class)
            ->set('username', 'forceEnter')
            ->set('password', 'pleaseLetMeIn')
            ->call('submit')
            ->assertHasErrors('invalidCredentials');
    }

    public function testCanLoginWithValidCredentials(): void
    {
        $this->createValidUser();

        Livewire::test(Login::class)
            ->set('username', 'test')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect(route('index'));

        Livewire::test(Login::class)
            ->set('username', 'test@test.com')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect(route('index'));
    }

    private function createValidUser(): void
    {
        User::factory()
            ->create([
                'username' => 'test',
                'email'    => 'test@test.com',
                'password' => Hash::make('password'),
            ]);
    }
}
