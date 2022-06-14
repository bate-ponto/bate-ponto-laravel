<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class SwitchDay extends Component
{
    public Carbon $date;

    public function mount(): void
    {
        $this->date = today();
    }

    public function previousDate(): void
    {
        $this->date->subDay();
        $this->emitDate();
    }

    public function nextDate(): void
    {
        $this->date->addDay();
        $this->emitDate();
    }

    private function emitDate(): void
    {
        $this->emit('date::changed', $this->date);
    }

    public function render(): View
    {
        return view('livewire.switch-day');
    }
}
