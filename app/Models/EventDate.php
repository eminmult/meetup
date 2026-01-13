<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class EventDate extends Model
{
    protected $fillable = [
        'event_id',
        'date',
        'start_time',
        'end_time',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getFormattedDateAttribute(): string
    {
        $locale = app()->getLocale();

        return match($locale) {
            'ru' => $this->date->translatedFormat('j F, l'),
            'az' => $this->date->translatedFormat('j F, l'),
            default => $this->date->format('F j, l'),
        };
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

    public function getIsPastAttribute(): bool
    {
        return $this->date->isPast();
    }

    public function getIsUpcomingAttribute(): bool
    {
        return $this->date->isFuture() || $this->date->isToday();
    }
}
