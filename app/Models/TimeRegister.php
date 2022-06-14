<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};

class TimeRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'start_time',
        'end_time',
        'duration',
        'user_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
        'duration'   => 'datetime',
    ];

    public function scopeFromUser(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeFromToday(Builder $query): Builder
    {
        return $query->whereDate('start_time', today());
    }

    public function scopeFromDate(Builder $query, Carbon $date): Builder
    {
        return $query->whereDate('start_time', $date);
    }
}
