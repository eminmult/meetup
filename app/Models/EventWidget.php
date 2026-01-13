<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventWidget extends Model
{
    protected $fillable = [
        'event_id',
        'type',
        'content',
        'order',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Extract YouTube video ID from URL or return as is if already an ID
     */
    public static function extractYoutubeId($input): string
    {
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        $patterns = [
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/',
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/v\/([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $input, $matches)) {
                return $matches[1];
            }
        }

        return $input;
    }

    /**
     * Extract OK.ru video ID from URL or return as is if already an ID
     */
    public static function extractOkruId($input): string
    {
        if (preg_match('/^\d+$/', $input)) {
            return $input;
        }

        $patterns = [
            '/ok\.ru\/video\/(\d+)/',
            '/ok\.ru\/videoembed\/(\d+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $input, $matches)) {
                return $matches[1];
            }
        }

        return $input;
    }

    /**
     * Extract Instagram post ID from URL or return as is if already an ID
     */
    public static function extractInstagramId($input): string
    {
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        $patterns = [
            '/instagram\.com\/p\/([a-zA-Z0-9_-]+)/',
            '/instagram\.com\/reel\/([a-zA-Z0-9_-]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $input, $matches)) {
                return $matches[1];
            }
        }

        return $input;
    }

    /**
     * Set content attribute with smart extraction
     */
    public function setContentAttribute($value)
    {
        if ($this->type === 'youtube') {
            $this->attributes['content'] = self::extractYoutubeId($value);
        } elseif ($this->type === 'okru') {
            $this->attributes['content'] = self::extractOkruId($value);
        } else {
            $this->attributes['content'] = $value;
        }
    }
}
