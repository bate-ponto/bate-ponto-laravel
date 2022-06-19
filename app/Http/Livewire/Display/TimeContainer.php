<?php

namespace App\Http\Livewire\Display;

use App\Models\TimeRegister;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class TimeContainer extends Component
{
    public array $timeRegisters;

    public Carbon $date;

    protected $listeners = [
        'changeStatus'  => 'setTimeRegisters',
        'date::changed' => 'dateChanged',
    ];

    public function mount(): void
    {
        $this->date = today();

        $this->setTimeRegisters();
    }

    public function updatedTimeRegisters(string $value, string $key): void
    {
        [$id, $field] = explode('.', $key);

        if ($field === 'description') {
            TimeRegister::where('id', $id)->update([
                'description' => $value,
            ]);

            $this->emitSelf('$refresh');
        }
    }

    public function dateChanged(string $date): void
    {
        $this->date = Carbon::parse($date);

        $this->setTimeRegisters();

        $this->emitSelf('$refresh');
    }

    public function setTimeRegisters(): void
    {
        $this->timeRegisters = TimeRegister::query()
            ->fromUser()
            ->fromDate($this->date)
            ->orderBy('start_time')
            ->select('description', 'start_time', 'end_time', 'id')
            ->get()
            ->mapWithKeys(function (TimeRegister $timeRegister) {
                return [
                    $timeRegister->id => [
                        'description' => $timeRegister->description,
                        'start_time'  => $timeRegister->start_time->format('H:i:s'),
                        'end_time'    => $timeRegister->end_time?->format('H:i:s') ?? '00:00:00',
                        'duration'    => convertNumberIntoTimeFormat($timeRegister->duration ?? 0),
                    ],
                ];
            })
            ->toArray();
    }

    public function render(): View
    {
        return view('livewire.display.time-container');
    }
}
