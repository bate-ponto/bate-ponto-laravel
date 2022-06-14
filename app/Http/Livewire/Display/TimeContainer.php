<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class TimeContainer extends Component
{
    public Collection $timeRegisters;

    protected $listeners = [
        'changeStatus'  => '$refresh',
        'date::changed' => 'dateChanged',
    ];

    public function mount(): void
    {
        $this->timeRegisters = $this->getTimeRegisters(today());
    }

    public function dateChanged(string $date): void
    {
        $this->timeRegisters = $this->getTimeRegisters(Carbon::parse($date));
        $this->emitSelf('$refresh');
    }

    private function getTimeRegisters(Carbon $date): Collection
    {
        return TimeRegister::query()
            ->fromUser()
            ->fromDate($date)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.display.time-container');
    }
}
