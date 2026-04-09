<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TeamMember extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected static function booted(): void
    {
        static::saving(function (TeamMember $member) {
            // Auto-fill base columns from translations if empty
            if (empty($member->name) && !empty($member->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($member->translations[$lang]['name'])) {
                        $member->name = $member->translations[$lang]['name'];
                        break;
                    }
                }
            }

            if (empty($member->slug) && !empty($member->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($member->translations[$lang]['slug'])) {
                        $member->slug = $member->translations[$lang]['slug'];
                        break;
                    }
                }
            }

            if (empty($member->position) && !empty($member->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($member->translations[$lang]['position'])) {
                        $member->position = $member->translations[$lang]['position'];
                        break;
                    }
                }
            }
        });
    }

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

    public function getNameAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['name'] ?? $value ?? null;
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

    public function getPositionAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['position'] ?? $value ?? null;
    }

    public function getBioAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['bio'] ?? $value ?? null;
    }

    public function getTaglineAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['tagline'] ?? $value ?? null;
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
        $locale = app()->getLocale();
        return route('team.show', ['locale' => $locale, 'slug' => $this->slug]);
    }
}
