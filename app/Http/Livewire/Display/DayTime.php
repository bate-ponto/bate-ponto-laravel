<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Illuminate\View\View;
use Livewire\Component;

class DayTime extends Component
{
    public function getTimeMadeProperty(): string
    {
        return convertNumberIntoTimeFormat(TimeRegister::query()
            ->fromUser()
            ->fromToday()
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time'));
    }

    public function render(): View
    {
        return view('livewire.display.day-time', [
            'timeMade' => $this->timeMade,
        ]);
    }
}
