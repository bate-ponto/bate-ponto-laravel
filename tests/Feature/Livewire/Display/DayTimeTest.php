<?php

namespace Tests\Feature\Livewire\Display;

use App\Http\Livewire\Display\DayTime;
use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class DayTimeTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderDayTimeComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(DayTime::class)
            ->assertViewIs('livewire.display.day-time');
    }

    public function testInitializeDayTimeCorrectly(): void
    {
        Livewire::actingAs($this->user)
            ->test(DayTime::class)
            ->assertSet('date', today())
            ->assertSet('timeMade', 0);
    }

    public function testCanChangeDate(): void
    {
        Livewire::actingAs($this->user)
            ->test(DayTime::class)
            ->call('dateChanged', '2022-05-03')
            ->assertSet('date', Carbon::parse('2022-05-03'));
    }

    public function testTimeMadeSetCorrectly(): void
    {
        $this->createTimeRegisters();

        Livewire::actingAs($this->user)
            ->test(DayTime::class)
            ->assertSet('timeMade', 0)
            ->call('dateChanged', '2022-06-08')
            ->call('setTimeAlreadyMade')
            ->assertSet('timeMade', 300);
    }

    private function createTimeRegisters(): void
    {
        $date = Carbon::parse('2022-06-08');

        TimeRegister::factory()
            ->count(10)
            ->sequence(function () use ($date) {
                return [
                    'user_id'    => $this->user->id,
                    'start_time' => $date->addSeconds(30),
                    'end_time'   => $date->clone()->addSeconds(30),
                ];
            })
            ->create();
    }
}
