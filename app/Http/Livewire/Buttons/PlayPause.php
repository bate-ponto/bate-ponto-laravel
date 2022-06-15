<?php

namespace App\Http\Livewire\Buttons;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class PlayPause extends Component
{
    public ?TimeRegister $timeRegister = null;

    public Carbon $date;

    public bool $isPlaying = false;

    protected $listeners = [
        'date::changed' => 'dateChanged',
    ];

    public function mount(): void
    {
        $this->date = today();

        $this->isPlaying = $this->getTimeRegisterStatus();
    }

    public function dateChanged(string $date): void
    {
        $this->date = Carbon::parse($date);

        $this->isPlaying = $this->getTimeRegisterStatus();
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

    private function getTimeRegisterStatus(): bool
    {
        $this->timeRegister = TimeRegister::query()
            ->fromUser()
            ->fromDate($this->date)
            ->whereNull('end_time')
            ->orderBy('start_time')
            ->latest()
            ->first();

        return isset($this->timeRegister);
    }

    public function render(): View
    {
        return view('livewire.buttons.play-pause');
    }
}
