<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected static function booted(): void
    {
        static::saving(function (Service $service) {
            // Auto-fill base columns from translations if empty
            if (empty($service->title) && !empty($service->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($service->translations[$lang]['title'])) {
                        $service->title = $service->translations[$lang]['title'];
                        break;
                    }
                }
            }

            if (empty($service->slug) && !empty($service->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($service->translations[$lang]['slug'])) {
                        $service->slug = $service->translations[$lang]['slug'];
                        break;
                    }
                }
            }

            if (empty($service->content) && !empty($service->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($service->translations[$lang]['content'])) {
                        $service->content = $service->translations[$lang]['content'];
                        break;
                    }
                }
            }
        });
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'price',
        'price_text',
        'duration',
        'icon',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'is_featured',
        'sort_order',
        'translations',
        'offers',
        'process',
        'pricing',
        'faq',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'translations' => 'array',
        'offers' => 'array',
        'process' => 'array',
        'pricing' => 'array',
        'faq' => 'array',
    ];

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale][$field] ?? $this->{$field} ?? null;
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

    public function getContentAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['content'] ?? $value ?? null;
    }

    public function getExcerptAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['excerpt'] ?? $value ?? null;
    }

    public function getMetaTitleAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['meta_title'] ?? $value ?? null;
    }

    public function getMetaDescriptionAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['meta_description'] ?? $value ?? null;
    }

    public function getDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['content'] ?? $this->attributes['content'] ?? null;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('service-gallery')
            ->useDisk('public')
            ->useFallbackUrl('/images/placeholder.jpg');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 450, 300)
            ->quality(70)
            ->performOnCollections('service-gallery')
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 700, 467)
            ->quality(72)
            ->performOnCollections('service-gallery')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 1200, 800)
            ->quality(75)
            ->performOnCollections('service-gallery')
            ->nonQueued();

        $this->addMediaConversion('webp')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Max, 1000, 1000)
            ->quality(73)
            ->performOnCollections('service-gallery')
            ->nonQueued();
    }

    public function getFeaturedImageAttribute()
    {
        $firstMedia = $this->getFirstMedia('service-gallery');
        return $firstMedia ? $firstMedia->getFullUrl() : null;
    }

    public function getFeaturedImageThumbAttribute()
    {
        $firstMedia = $this->getFirstMedia('service-gallery');
        return $firstMedia ? $firstMedia->getUrl('thumb') : null;
    }

    public function getFeaturedImageMediumAttribute()
    {
        $firstMedia = $this->getFirstMedia('service-gallery');
        return $firstMedia ? $firstMedia->getUrl('medium') : null;
    }

    public function getPriceDisplayAttribute(): string
    {
        if ($this->price_text) {
            return $this->price_text;
        }
        if ($this->price) {
            return number_format($this->price, 2) . ' ₼';
        }
        return 'По запросу';
    }

    public function getUrlAttribute()
    {
        $locale = app()->getLocale();
        return route('service.show', ['locale' => $locale, 'slug' => $this->slug]);
    }
}
