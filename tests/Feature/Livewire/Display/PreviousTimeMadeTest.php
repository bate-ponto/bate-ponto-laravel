<?php

namespace Tests\Feature\Livewire\Display;

use App\Http\Livewire\Display\PreviousTimeMade;
use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class PreviousTimeMadeTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderPreviousTimeMadeComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(PreviousTimeMade::class)
            ->assertViewIs('livewire.display.previous-time-made');
    }

    public function testCanChangeDate(): void
    {
        Livewire::actingAs($this->user)
            ->test(PreviousTimeMade::class)
            ->assertSet('selectedDate', today())
            ->call('dateChanged', '2022-05-06')
            ->assertSet('selectedDate', Carbon::parse('2022-05-06'));
    }

    public function testMonthAndWeekValuesAreShowingCorrectly(): void
    {
        $this->createTimeRegisters();

        $this->travelTo(Carbon::parse('2022-04-01'));

        Livewire::actingAs($this->user)
            ->test(PreviousTimeMade::class)
            ->call('dateChanged', '2022-03-01')
            ->assertSet('selectedMonthTimeMade', 3600)
            ->assertSet('currentMonthTimeMade', 3600)
            ->assertSet('selectedWeekTimeMade', 3600)
            ->assertSet('currentWeekTimeMade', 3600);
    }

    private function createTimeRegisters(): void
    {
        TimeRegister::factory()
            ->create([
                'user_id'    => $this->user->id,
                'start_time' => '2022-03-01 01:02:03',
                'end_time'   => '2022-03-01 02:02:03',
            ]);

        TimeRegister::factory()
            ->create([
                'user_id'    => $this->user->id,
                'start_time' => '2022-04-01 02:00:00',
                'end_time'   => '2022-04-01 03:00:00',
            ]);
    }
}
