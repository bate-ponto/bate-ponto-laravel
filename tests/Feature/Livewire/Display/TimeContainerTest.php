<?php

namespace Tests\Feature\Livewire\Display;

use App\Http\Livewire\Display\TimeContainer;
use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\BaseTest;

class TimeContainerTest extends BaseTest
{
    use RefreshDatabase;

    public function testShouldRenderTimeContainerComponent(): void
    {
        Livewire::actingAs($this->user)
            ->test(TimeContainer::class)
            ->assertViewIs('livewire.display.time-container');
    }

    public function testInitializeDateCorrectly(): void
    {
        Livewire::actingAs($this->user)
            ->test(TimeContainer::class)
            ->assertSet('date', today())
            ->assertSet('timeRegisters', []);
    }

    public function testSaveDescriptionCorrectly(): void
    {
        $timeRegister = $this->createTimeRegisters();

        Livewire::actingAs($this->user)
            ->test(TimeContainer::class)
            ->call('dateChanged', '2022-05-03')
            ->set("timeRegisters.{$timeRegister->id}.description", 'test');

        $timeRegister->refresh();

        $this->assertEquals('test', $timeRegister->description);
    }

    public function testCanChangeDate(): void
    {
        Livewire::actingAs($this->user)
            ->test(TimeContainer::class)
            ->call('dateChanged', '2022-05-03')
            ->assertSet('date', Carbon::parse('2022-05-03'));
    }

    public function testSetTimeRegistersCorrectly(): void
    {
        $timeRegister = $this->createTimeRegisters();

        Livewire::actingAs($this->user)
            ->test(TimeContainer::class)
            ->assertSet('timeRegisters', [])
            ->call('dateChanged', '2022-05-03')
            ->assertSet('timeRegisters', [
                $timeRegister->id => [
                    'description' => null,
                    'start_time'  => '10:03:21',
                    'end_time'    => '10:30:24',
                    'duration'    => '00:27:03',
                ],
            ]);
    }

    private function createTimeRegisters(): TimeRegister
    {
        return TimeRegister::factory()
            ->create([
                'description' => null,
                'user_id'     => $this->user->id,
                'start_time'  => '2022-05-03 10:03:21',
                'end_time'    => '2022-05-03 10:30:24',
            ]);
    }
}
