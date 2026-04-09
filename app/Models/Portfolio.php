<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Portfolio extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected static function booted(): void
    {
        static::saving(function (Portfolio $portfolio) {
            // Auto-fill base columns from translations if empty
            if (empty($portfolio->title) && !empty($portfolio->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($portfolio->translations[$lang]['title'])) {
                        $portfolio->title = $portfolio->translations[$lang]['title'];
                        break;
                    }
                }
            }

            if (empty($portfolio->slug) && !empty($portfolio->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($portfolio->translations[$lang]['slug'])) {
                        $portfolio->slug = $portfolio->translations[$lang]['slug'];
                        break;
                    }
                }
            }
        });
    }

    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'description',
        'content',
        'website_url',
        'social_links',
        'video_url',
        'translations',
        'portfolio_category_id',
        'is_featured',
        'is_published',
        'sort_order',
        'project_date',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'social_links' => 'array',
        'translations' => 'array',
        'project_date' => 'date',
    ];

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale][$field] ?? $this->{$field} ?? null;
    }

    public function getSlugForLocale(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale]['slug'] ?? $this->slug ?? null;
    }

    public function getTitleAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['title'] ?? $value ?? null;
    }

    public function getSlugAttribute($value): string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['slug'] ?? $value ?? '';
    }

    public function getRawSlug(): ?string
    {
        return $this->attributes['slug'] ?? null;
    }

    public function getDescriptionAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['description'] ?? $value ?? null;
    }

    public function getContentAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['content'] ?? $value ?? null;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function registerMediaCollections(): void
    {
        // Логотип клиента
        $this->addMediaCollection('client-logo')
            ->useDisk('public')
            ->singleFile();

        // Галерея проекта
        $this->addMediaCollection('portfolio-gallery')
            ->useDisk('public')
            ->useFallbackUrl('/images/placeholder.jpg');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        // Логотип клиента
        $this->addMediaConversion('logo-thumb')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Contain, 200, 100)
            ->quality(90)
            ->performOnCollections('client-logo')
            ->nonQueued();

        // Галерея - маленькие превью
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 450, 300)
            ->quality(70)
            ->performOnCollections('portfolio-gallery')
            ->nonQueued();

        // Галерея - средние
        $this->addMediaConversion('medium')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 700, 467)
            ->quality(72)
            ->performOnCollections('portfolio-gallery')
            ->nonQueued();

        // Галерея - большие
        $this->addMediaConversion('large')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 1200, 800)
            ->quality(75)
            ->performOnCollections('portfolio-gallery')
            ->nonQueued();
    }

    public function getClientLogoAttribute(): ?string
    {
        $media = $this->getFirstMedia('client-logo');
        return $media ? $media->getUrl('logo-thumb') : null;
    }

    public function getFeaturedImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('portfolio-gallery');
        return $media ? $media->getFullUrl() : null;
    }

    public function getFeaturedImageThumbAttribute(): ?string
    {
        $media = $this->getFirstMedia('portfolio-gallery');
        return $media ? $media->getUrl('thumb') : null;
    }

    public function getFeaturedImageMediumAttribute(): ?string
    {
        $media = $this->getFirstMedia('portfolio-gallery');
        return $media ? $media->getUrl('medium') : null;
    }

    public function getUrlAttribute(): string
    {
        $locale = app()->getLocale();
        return route('portfolio.show', ['locale' => $locale, 'slug' => $this->slug]);
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        // YouTube
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $this->video_url;
    }
}
