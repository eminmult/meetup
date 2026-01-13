<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'author_name',
        'author_position',
        'text',
        'translations',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'translations' => 'array',
    ];

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale][$field] ?? $this->{$field} ?? null;
    }

    public function getAuthorNameAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['author_name'] ?? $value ?? null;
    }

    public function getAuthorPositionAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['author_position'] ?? $value ?? null;
    }

    public function getTextAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['text'] ?? $value ?? null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->useDisk('public')
            ->singleFile()
            ->useFallbackUrl('/images/default-avatar.jpg');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 100, 100)
            ->quality(85)
            ->performOnCollections('avatar')
            ->nonQueued();
    }

    public function getAvatarUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('avatar');
        return $media ? $media->getFullUrl() : '/images/default-avatar.jpg';
    }

    public function getAvatarThumbAttribute(): ?string
    {
        $media = $this->getFirstMedia('avatar');
        return $media ? $media->getUrl('thumb') : '/images/default-avatar.jpg';
    }
}
