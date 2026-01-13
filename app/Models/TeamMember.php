<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TeamMember extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'bio',
        'tagline',
        'stats',
        'skills',
        'email',
        'phone',
        'social_links',
        'translations',
        'is_published',
        'is_leader',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_leader' => 'boolean',
        'social_links' => 'array',
        'stats' => 'array',
        'skills' => 'array',
        'translations' => 'array',
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeLeaders($query)
    {
        return $query->where('is_leader', true);
    }

    public function scopeMembers($query)
    {
        return $query->where('is_leader', false);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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
            ->fit(\Spatie\Image\Enums\Fit::Crop, 300, 300)
            ->quality(80)
            ->performOnCollections('avatar')
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->format('webp')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 500, 500)
            ->quality(80)
            ->performOnCollections('avatar')
            ->nonQueued();
    }

    public function getAvatarUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('avatar');
        return $media ? $media->getFullUrl() : null;
    }

    public function getAvatarThumbAttribute(): ?string
    {
        $media = $this->getFirstMedia('avatar');
        return $media ? $media->getUrl('thumb') : '/images/default-avatar.jpg';
    }

    public function getAvatarMediumAttribute(): ?string
    {
        $media = $this->getFirstMedia('avatar');
        return $media ? $media->getUrl('medium') : '/images/default-avatar.jpg';
    }

    public function getUrlAttribute(): string
    {
        $frontendUrl = config('app.frontend_url', config('app.url'));
        return $frontendUrl . '/team/' . $this->slug;
    }
}
