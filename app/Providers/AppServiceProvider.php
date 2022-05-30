<?php

namespace App\Providers;

use App\Models\TimeRegister;
use App\Observers\TimerRegisterObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    
    public function boot(): void
    {
        TimeRegister::observe(TimerRegisterObserver::class);
    }
}
