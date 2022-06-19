<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\{Artisan, Route};
use Tests\BaseTest;

class RoutesTest extends BaseTest
{
    protected const NOT_LOGGED_ROUTES = [
        'login',
        'register',
    ];

    protected const LOGGED_ROUTES = [
        'index',
        'user',
    ];

    public function testNotLoggedUserCanAccessUnauthorizedRoutes(): void
    {
        foreach (self::NOT_LOGGED_ROUTES as $route) {
            $this->get(route($route))
                ->assertStatus(200);
        }
    }

    public function testLoggedUserCannotAccessUnauthorizedRoutes(): void
    {
        foreach (self::NOT_LOGGED_ROUTES as $route) {
            $this->actingAs($this->user)
                ->get(route($route))
                ->assertStatus(302)
                ->assertRedirect('/');
        }
    }

    public function testNotLoggedUserCannotAccessAuthorizedRoutes(): void
    {
        foreach (self::LOGGED_ROUTES as $route) {
            $this->get(route($route))
                ->assertStatus(302)
                ->assertRedirect(route('login'));
        }
    }

    public function testLoggedUserCanAccessAuthorizedRoutes(): void
    {
        foreach (self::LOGGED_ROUTES as $route) {
            $this->actingAs($this->user)
                ->get(route($route))
                ->assertStatus(200);
        }
    }
}
