<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'translations',
        'icon',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'translations' => 'array',
        'is_published' => 'boolean',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class);
    }

    public function dates(): HasMany
    {
        return $this->hasMany(EventDate::class)->orderBy('date');
    }

    public function upcomingDates(): HasMany
    {
        return $this->hasMany(EventDate::class)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date');
    }

    public function widgets(): HasMany
    {
        return $this->hasMany(EventWidget::class)->orderBy('order');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getTitleAttribute(): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['title'] ?? $this->translations['ru']['title'] ?? null;
    }

    public function getDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['description'] ?? $this->translations['ru']['description'] ?? null;
    }

    public function getSlugAttribute($value): string
    {
        $locale = app()->getLocale();

        // Get slug from translations for current locale
        $slug = $this->translations[$locale]['slug'] ?? null;

        if ($slug) {
            return $slug;
        }

        // Generate slug from title if not set
        $title = $this->translations[$locale]['title']
            ?? $this->translations['ru']['title']
            ?? $this->translations['en']['title']
            ?? 'event';

        $generatedSlug = \Illuminate\Support\Str::slug($title);

        // Auto-save the generated slug
        $this->saveGeneratedSlugs();

        return $generatedSlug;
    }

    /**
     * Generate and save slugs for all languages
     */
    public function saveGeneratedSlugs(): void
    {
        $translations = $this->translations ?? [];
        $needsSave = false;

        foreach (['ru', 'en', 'az'] as $locale) {
            if (isset($translations[$locale]['title']) && empty($translations[$locale]['slug'])) {
                $translations[$locale]['slug'] = \Illuminate\Support\Str::slug($translations[$locale]['title']);
                $needsSave = true;
            }
        }

        if ($needsSave && $this->exists) {
            $this->timestamps = false; // Don't update timestamps
            $this->update(['translations' => $translations]);
            $this->timestamps = true;
        }
    }

    /**
     * Получить форматированное расписание для отображения
     */
    public function getFormattedScheduleAttribute(): string
    {
        $locale = app()->getLocale();
        $days = $this->getDayNames($locale);

        $scheduleStrings = [];

        foreach ($this->schedules as $schedule) {
            $dayName = $days[$schedule->day_of_week] ?? '';
            $time = substr($schedule->start_time, 0, 5);
            $scheduleStrings[] = "{$dayName}, {$time}";
        }

        return implode(' | ', $scheduleStrings);
    }

    protected function getDayNames(string $locale): array
    {
        return match($locale) {
            'ru' => [
                1 => 'Каждый понедельник',
                2 => 'Каждый вторник',
                3 => 'Каждую среду',
                4 => 'Каждый четверг',
                5 => 'Каждую пятницу',
                6 => 'Каждую субботу',
                7 => 'Каждое воскресенье',
            ],
            'az' => [
                1 => 'Hər bazar ertəsi',
                2 => 'Hər çərşənbə axşamı',
                3 => 'Hər çərşənbə',
                4 => 'Hər cümə axşamı',
                5 => 'Hər cümə',
                6 => 'Hər şənbə',
                7 => 'Hər bazar',
            ],
            default => [
                1 => 'Every Monday',
                2 => 'Every Tuesday',
                3 => 'Every Wednesday',
                4 => 'Every Thursday',
                5 => 'Every Friday',
                6 => 'Every Saturday',
                7 => 'Every Sunday',
            ],
        };
    }

    /**
     * Register media collections for gallery
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('event-gallery')
            ->useDisk('public');
    }

    /**
     * Register media conversions
     */
    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        // Маленькие превью для админки
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 450, 300)
            ->quality(70)
            ->performOnCollections('event-gallery')
            ->nonQueued();

        // Средние превью для карточек
        $this->addMediaConversion('medium')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 700, 467)
            ->quality(72)
            ->performOnCollections('event-gallery')
            ->nonQueued();

        // Большие изображения для слайдеров
        $this->addMediaConversion('large')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 1200, 800)
            ->quality(75)
            ->performOnCollections('event-gallery')
            ->nonQueued();
    }

    /**
     * Get featured image URL
     */
    public function getFeaturedImageAttribute(): ?string
    {
        $firstMedia = $this->getFirstMedia('event-gallery');
        return $firstMedia ? $firstMedia->getFullUrl() : null;
    }

    /**
     * Get featured image thumb URL
     */
    public function getFeaturedImageThumbAttribute(): ?string
    {
        $firstMedia = $this->getFirstMedia('event-gallery');
        return $firstMedia ? $firstMedia->getUrl('thumb') : null;
    }
}
