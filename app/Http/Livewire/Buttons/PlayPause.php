<?php

namespace App\Http\Livewire\Buttons;

use App\Models\TimeRegister;
use Illuminate\View\View;
use Livewire\Component;

class PlayPause extends Component
{
    public ?TimeRegister $timeRegister = null;

    public bool $isPlaying = false;

    public function mount(): void
    {
        $this->timeRegister = TimeRegister::query()
            ->fromUser()
            ->whereNull('end_time')
            ->latest()
            ->first();

        if ($this->timeRegister) {
            $this->isPlaying = true;
        }
    }

    public function toggle(): void
    {
        $this->isPlaying = !$this->isPlaying;

        if ($this->isPlaying) {
            $this->timeRegister = TimeRegister::create([
                'user_id' => auth()->id(),
                'start_time' => now(),
            ]);
        } else {
            $this->timeRegister->update([
                'end_time' => now(),
            ]);
        }

        $this->emit('changeStatus');
    }

    public function render(): View
    {
        return view('livewire.buttons.play-pause');
    }
}
