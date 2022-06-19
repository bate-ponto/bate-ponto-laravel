<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\SwitchDay;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class SwitchDayTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderSwitchDayComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(SwitchDay::class)
            ->assertViewIs('livewire.switch-day');
    }

    public function testShouldInitializeDateAsToday(): void
    {
        Livewire::actingAs($this->user)
            ->test(SwitchDay::class)
            ->assertSet('date', today());
    }

    public function testShouldGoToPreviousDate(): void
    {
        Livewire::actingAs($this->user)
            ->test(SwitchDay::class)
            ->call('previousDate')
            ->assertEmitted('date::changed')
            ->assertSet('date', today()->subDay());
    }

    public function testShouldGoToNextDate(): void
    {
        Livewire::actingAs($this->user)
            ->test(SwitchDay::class)
            ->call('nextDate')
            ->assertEmitted('date::changed')
            ->assertSet('date', today()->addDay());
    }
}
