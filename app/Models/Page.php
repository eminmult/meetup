<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected static function booted(): void
    {
        static::saving(function (Page $page) {
            // Auto-generate slug from title if empty
            if (empty($page->slug) && !empty($page->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($page->translations[$lang]['title'])) {
                        $page->slug = \Illuminate\Support\Str::slug($page->translations[$lang]['title']);
                        break;
                    }
                }
            }
        });
    }

    protected $fillable = [
        'slug',
        'template',
        'translations',
        'sections',
        'seo',
        'is_published',
        'show_in_menu',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_in_menu' => 'boolean',
        'translations' => 'array',
        'sections' => 'array',
        'seo' => 'array',
    ];

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale][$field] ?? null;
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getTranslation('title') ?? $this->getTranslation('name');
    }

    public function getContentAttribute(): ?string
    {
        return $this->getTranslation('content');
    }

    public function getSection(string $section, ?string $locale = null): ?array
    {
        $locale = $locale ?? app()->getLocale();
        return $this->sections[$section][$locale] ?? $this->sections[$section]['ru'] ?? null;
    }

    public function getSectionField(string $section, string $field, ?string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();
        return $this->sections[$section][$locale][$field]
            ?? $this->sections[$section]['ru'][$field]
            ?? $this->sections[$section][$field]
            ?? null;
    }

    public function getSectionItems(string $section): ?array
    {
        return $this->sections[$section]['items'] ?? null;
    }

    public function getSeoField(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->seo[$locale][$field] ?? $this->seo['ru'][$field] ?? null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true);
    }

    public function getUrlAttribute(): string
    {
        $frontendUrl = config('app.frontend_url', config('app.url'));
        return $frontendUrl . '/' . $this->slug;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('page-gallery')
            ->useDisk('public')
            ->useFallbackUrl('/images/placeholder.jpg');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 450, 300)
            ->quality(70)
            ->performOnCollections('page-gallery')
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 700, 467)
            ->quality(72)
            ->performOnCollections('page-gallery')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 1200, 800)
            ->quality(75)
            ->performOnCollections('page-gallery')
            ->nonQueued();

        $this->addMediaConversion('webp')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Max, 1000, 1000)
            ->quality(73)
            ->performOnCollections('page-gallery')
            ->nonQueued();
    }

    public function getFeaturedImageAttribute()
    {
        $firstMedia = $this->getFirstMedia('page-gallery');
        return $firstMedia ? $firstMedia->getFullUrl() : null;
    }

    public function getFeaturedImageThumbAttribute()
    {
        $firstMedia = $this->getFirstMedia('page-gallery');
        return $firstMedia ? $firstMedia->getUrl('thumb') : null;
    }

    public function getFeaturedImageMediumAttribute()
    {
        $firstMedia = $this->getFirstMedia('page-gallery');
        return $firstMedia ? $firstMedia->getUrl('medium') : null;
    }
}
