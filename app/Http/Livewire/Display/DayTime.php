<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class DayTime extends Component
{
    public int $timeMade = 0;

    protected $listeners = [
        'date::changed' => 'dateChanged',
    ];

    public function mount(): void
    {
        $this->timeMade = $this->getTimeAlreadyMade(today());
    }

    public function dateChanged(string $date): void
    {
        $this->timeMade = $this->getTimeAlreadyMade(Carbon::parse($date));
    }

    private function getTimeAlreadyMade(Carbon $date): int
    {
        return TimeRegister::query()
            ->fromUser()
            ->fromDate($date)
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time');
    }

    public function render(): View
    {
        return view('livewire.display.day-time');
    }
}
