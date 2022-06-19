<?php

namespace Tests;

use App\Models\User;

class BaseTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
}
