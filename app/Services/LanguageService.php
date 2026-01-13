<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageService
{
    /**
     * Get all active language codes as array
     */
    public static function getActiveCodes(): array
    {
        return Cache::remember('active_language_codes', 3600, function () {
            try {
                return Language::active()->ordered()->pluck('code')->toArray();
            } catch (\Exception $e) {
                // Fallback if database is not available
                return ['ru', 'en', 'az'];
            }
        });
    }

    /**
     * Get active language codes as regex pattern (ru|en|az)
     */
    public static function getLocalePattern(): string
    {
        $codes = self::getActiveCodes();
        return implode('|', $codes);
    }

    /**
     * Get default locale code
     */
    public static function getDefaultCode(): string
    {
        return Cache::remember('default_language_code', 3600, function () {
            try {
                $default = Language::where('is_default', true)->first();
                return $default?->code ?? config('app.locale', 'ru');
            } catch (\Exception $e) {
                return config('app.locale', 'ru');
            }
        });
    }

    /**
     * Get all active languages as collection
     */
    public static function getActiveLanguages()
    {
        return Cache::remember('active_languages', 3600, function () {
            try {
                return Language::active()->ordered()->get();
            } catch (\Exception $e) {
                return collect();
            }
        });
    }

    /**
     * Check if locale is valid
     */
    public static function isValidLocale(string $locale): bool
    {
        return in_array($locale, self::getActiveCodes());
    }

    /**
     * Clear language cache
     */
    public static function clearCache(): void
    {
        Cache::forget('active_language_codes');
        Cache::forget('default_language_code');
        Cache::forget('active_languages');
    }
}
