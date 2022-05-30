<?php

namespace App\Http\Livewire\Display;

use Illuminate\View\View;
use Livewire\Component;

class DayTime extends Component
{
    public string $timeMade = "00:00:00";

    public function render(): View
    {
        return view('livewire.display.day-time');
    }
}
