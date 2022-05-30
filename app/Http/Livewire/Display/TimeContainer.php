<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class TimeContainer extends Component
{
    protected $listeners = [
        'changeStatus' => '$refresh',
    ];

    public function getTimeRegistersProperty(): Collection
    {
        return TimeRegister::query()
            ->fromUser()
            ->fromToday()
            ->get();
    }

    public function render(): View
    {
        return view('livewire.display.time-container', [
            'timeRegisters' => $this->timeRegisters,
        ]);
    }
}
