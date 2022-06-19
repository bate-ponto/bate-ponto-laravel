<?php

namespace Tests\Feature\Livewire\Pages;

use App\Http\Livewire\Pages\Index;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class IndexTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderIndexPageComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(Index::class)
            ->assertViewIs('livewire.pages.index');
    }
}
