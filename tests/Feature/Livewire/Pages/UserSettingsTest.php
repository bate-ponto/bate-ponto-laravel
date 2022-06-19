<?php

namespace Tests\Feature\Livewire\Pages;

use App\Http\Livewire\Pages\UserSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class UserSettingsTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderUserSettingsComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(UserSettings::class)
            ->assertViewIs('livewire.pages.user-settings');
    }

    public function testInitializeLoggedUser(): void
    {
        Livewire::actingAs($this->user)
            ->test(UserSettings::class)
            ->assertSet('user', $this->user);
    }

    public function testValidationFailsWhenRequiredFieldIsEmpty(): void
    {
        Livewire::actingAs($this->user)
            ->test(UserSettings::class)
            ->set('user.name', '')
            ->set('user.username', '')
            ->set('user.email', '')
            ->call('submit')
            ->assertHasErrors([
                'user.name'     => 'required',
                'user.username' => 'required',
                'user.email'    => 'required',
            ]);
    }

    public function testValidationFailsWhenPasswordIsIncorrect(): void
    {
        Livewire::actingAs($this->user)
            ->test(UserSettings::class)
            ->call('submit')
            ->assertHasNoErrors([
                'password',
                'passwordConfirmation',
            ])
            ->set('password', 'password123')
            ->call('submit')
            ->assertHasErrors([
                'passwordConfirmation' => 'required_with',
            ])
            ->set('passwordConfirmation', 'password312')
            ->call('submit')
            ->assertHasErrors([
                'passwordConfirmation' => 'same',
            ]);
    }

    public function testUserSavedCorrectly(): void
    {
        Livewire::actingAs($this->user)
            ->test(UserSettings::class)
            ->set('user.name', 'Michael')
            ->set('user.email', 'michael@test.com')
            ->set('user.username', 'michael.admin')
            ->call('submit');

        $this->user->refresh();

        $this->assertEquals('Michael', $this->user->name);
        $this->assertEquals('michael@test.com', $this->user->email);
        $this->assertEquals('michael.admin', $this->user->username);
    }

    public function testUserCanChangePassword(): void
    {
        $oldPassword = $this->user->password;

        Livewire::actingAs($this->user)
            ->test(UserSettings::class)
            ->set('password', 'Michael123')
            ->set('passwordConfirmation', 'Michael123')
            ->call('submit');

        $this->user->refresh();

        $this->assertNotEquals($oldPassword, $this->user->password);
    }
}
