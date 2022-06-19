<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseTest;

class LoginControllerTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldLogoutLoggedUser(): void
    {
        $this->actingAs($this->user);

        $this->post(route('logout'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
