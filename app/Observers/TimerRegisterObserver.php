<?php

namespace App\Observers;

use App\Models\TimeRegister;

class TimerRegisterObserver
{
    public function saving(TimeRegister $timeRegister): void
    {  
        if ($timeRegister->isDirty('end_time')) {
            $timeRegister->duration = $timeRegister->start_time->diffInSeconds($timeRegister->end_time);
        }
    }
}
