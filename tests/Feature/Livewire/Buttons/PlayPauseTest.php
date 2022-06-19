<?php

namespace Tests\Feature\Livewire\Buttons;

use App\Http\Livewire\Buttons\PlayPause;
use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class PlayPauseTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderPlayPauseComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(PlayPause::class)
            ->assertViewIs('livewire.buttons.play-pause');
    }

    public function testInitializeVariablesCorrectly(): void
    {
        $this->travelTo(Carbon::parse('2022-06-03'));

        Livewire::actingAs($this->user)
            ->test(PlayPause::class)
            ->assertSet('date', today())
            ->assertSet('isPlaying', false);

        $this->createTimeRegister();

        Livewire::actingAs($this->user)
            ->test(PlayPause::class)
            ->assertSet('isPlaying', true);
    }

    public function testValuesChangeWhenDateChanges(): void
    {
        $this->travelTo(Carbon::parse('2022-06-10'));

        Livewire::actingAs($this->user)
            ->test(PlayPause::class)
            ->assertSet('date', Carbon::parse('2022-06-10'))
            ->call('dateChanged', '2022-06-03')
            ->assertSet('date', Carbon::parse('2022-06-03'))
            ->assertSet('isPlaying', false);
    }

    public function testToggleCreateOrUpdateTimeRegister(): void
    {
        $this->travelTo(Carbon::parse('2022-06-10 10:20:30'));

        Livewire::actingAs($this->user)
            ->test(PlayPause::class)
            ->assertSet('isPlaying', false)
            ->assertSet('timeRegister', null)
            ->call('toggle')
            ->assertSet('isPlaying', true)
            ->assertSet('timeRegister.user_id', $this->user->id)
            ->assertSet('timeRegister.start_time', Carbon::parse('2022-06-10 10:20:30'))
            ->assertSet('timeRegister.end_time', null)
            ->assertSet('timeRegister.duration', null);

        $this->travelTo(Carbon::parse('2022-06-10 11:30:30'));

        Livewire::actingAs($this->user)
            ->test(PlayPause::class)
            ->assertSet('isPlaying', true)
            ->assertSet('timeRegister.user_id', $this->user->id)
            ->assertSet('timeRegister.start_time', Carbon::parse('2022-06-10 10:20:30'))
            ->assertSet('timeRegister.end_time', null)
            ->assertSet('timeRegister.duration', null)
            ->call('toggle')
            ->assertSet('isPlaying', false)
            ->assertSet('timeRegister.user_id', $this->user->id)
            ->assertSet('timeRegister.start_time', Carbon::parse('2022-06-10 10:20:30'))
            ->assertSet('timeRegister.end_time', Carbon::parse('2022-06-10 11:30:30'))
            ->assertSet('timeRegister.duration', 4200);
    }

    private function createTimeRegister(): void
    {
        TimeRegister::factory()
            ->create([
                'user_id'    => $this->user->id,
                'start_time' => '2022-06-03',
                'end_time'   => null,
            ]);
    }
}
