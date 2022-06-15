<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class DayTime extends Component
{
    public int $timeMade = 0;

    public Carbon $date;

    protected $listeners = [
        'changeStatus'  => 'setTimeAlreadyMade',
        'date::changed' => 'dateChanged',
    ];

    public function mount(): void
    {
        $this->date = today();

        $this->setTimeAlreadyMade();
    }

    public function dateChanged(string $date): void
    {
        $this->date = Carbon::parse($date);
        $this->setTimeAlreadyMade();
    }

    public function setTimeAlreadyMade(): void
    {
        $this->timeMade = TimeRegister::query()
            ->fromUser()
            ->fromDate($this->date)
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time');
    }

    public function render(): View
    {
        return view('livewire.display.day-time');
    }
}
