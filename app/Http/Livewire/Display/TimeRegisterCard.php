<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Illuminate\View\View;
use Livewire\Component;

class TimeRegisterCard extends Component
{
    public TimeRegister $timeRegister;

    protected $rules = [
        'timeRegister.description' => 'nullable|string',
    ];

    protected $listeners = [
        'changeStatus' => '$refresh',
    ];

    public function updatedTimeRegisterDescription(?string $value): void
    {
        $this->timeRegister->save();
    }

    public function render(): View
    {
        return view('livewire.display.time-register-card');
    }
}
