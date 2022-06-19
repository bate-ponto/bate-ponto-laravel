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
        'user_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    public function getDurationAttribute(): ?int
    {
        if (!$this->end_time) {
            return null;
        }

        return $this->end_time->diffInSeconds($this->start_time);
    }

    public function scopeFromUser(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeFromDate(Builder $query, Carbon $date): Builder
    {
        return $query->whereDate('start_time', $date);
    }
}
