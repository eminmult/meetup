<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSchedule extends Model
{
    protected $fillable = [
        'event_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'day_of_week' => 'integer',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getDayNameAttribute(): string
    {
        $locale = app()->getLocale();

        $days = match($locale) {
            'ru' => ['', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
            'az' => ['', 'Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı', 'Cümə', 'Şənbə', 'Bazar'],
            default => ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        };

        return $days[$this->day_of_week] ?? '';
    }

    public function getFormattedTimeAttribute(): string
    {
        if (!$this->start_time) {
            return '';
        }
        $time = $this->start_time->format('H:i');
        if ($this->end_time) {
            $time .= ' - ' . $this->end_time->format('H:i');
        }
        return $time;
    }
}
