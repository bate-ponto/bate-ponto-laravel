<?php

namespace App\Http\Livewire\Buttons;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class PlayPause extends Component
{
    public ?TimeRegister $timeRegister = null;

    public bool $isPlaying = false;

    protected $listeners = [
        'date::changed' => 'dateChanged',
    ];

    public function mount(): void
    {
        $this->isPlaying = $this->getTimeRegisterStatus(today());
    }

    public function dateChanged(string $date): void
    {
        $this->isPlaying = $this->getTimeRegisterStatus(Carbon::parse($date));
    }

    public function toggle(): void
    {
        $this->isPlaying = !$this->isPlaying;

        if ($this->isPlaying) {
            $this->timeRegister = TimeRegister::create([
                'user_id'    => auth()->id(),
                'start_time' => now(),
            ]);
        } else {
            $this->timeRegister->update([
                'end_time' => now(),
            ]);
        }

        $this->emit('changeStatus');
    }

    private function getTimeRegisterStatus(Carbon $date): bool
    {
        $this->timeRegister = TimeRegister::query()
            ->fromUser()
            ->fromDate($date)
            ->whereNull('end_time')
            ->latest()
            ->first();

        if ($this->timeRegister) {
            return true;
        }

        return false;
    }

    public function render(): View
    {
        return view('livewire.buttons.play-pause');
    }
}
