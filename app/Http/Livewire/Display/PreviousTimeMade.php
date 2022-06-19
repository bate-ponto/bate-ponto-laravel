<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class PreviousTimeMade extends Component
{
    public Carbon $selectedDate;

    protected $listeners = [
        'date::changed' => 'dateChanged',
        'changeStatus'  => '$refresh',
    ];

    public function mount(): void
    {
        $this->selectedDate = today();
    }

    public function dateChanged(string $date): void
    {
        $this->selectedDate = Carbon::parse($date);
    }

    public function getSelectedMonthTimeMadeProperty(): int
    {
        return TimeRegister::query()
            ->fromUser()
            ->whereMonth('start_time', $this->selectedDate->month)
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time');
    }

    public function getCurrentMonthTimeMadeProperty(): int
    {
        return TimeRegister::query()
            ->fromUser()
            ->whereMonth('start_time', today()->month)
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time');
    }

    public function getSelectedWeekTimeMadeProperty(): int
    {
        return TimeRegister::query()
            ->fromUser()
            ->whereBetween('start_time', [
                $this->selectedDate->clone()->startOfWeek(),
                $this->selectedDate->clone()->endOfWeek(),
            ])
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time');
    }

    public function getCurrentWeekTimeMadeProperty(): int
    {
        return TimeRegister::query()
            ->fromUser()
            ->whereMonth('start_time', [
                today()->startOfWeek(),
                today()->endOfWeek(),
            ])
            ->selectRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) as time')
            ->get()
            ->sum('time');
    }

    public function render(): View
    {
        return view('livewire.display.previous-time-made', [
            'selectedMonthTimeMade' => $this->selectedMonthTimeMade,
            'currentMonthTimeMade'  => $this->currentMonthTimeMade,
            'selectedWeekTimeMade'  => $this->selectedWeekTimeMade,
            'currentWeekTimeMade'   => $this->currentWeekTimeMade,
        ]);
    }
}
