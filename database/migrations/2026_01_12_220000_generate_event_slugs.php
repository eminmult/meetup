<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use App\Models\Event;

return new class extends Migration
{
    public function up(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            $translations = $event->translations ?? [];
            $updated = false;

            // Generate slugs for each language
            foreach (['ru', 'en', 'az'] as $locale) {
                if (isset($translations[$locale]['title']) && empty($translations[$locale]['slug'])) {
                    $translations[$locale]['slug'] = Str::slug($translations[$locale]['title']);
                    $updated = true;
                }
            }

            if ($updated) {
                $event->translations = $translations;
                $event->save();
            }
        }
    }

    public function down(): void
    {
        // Remove slugs
        $events = Event::all();

        foreach ($events as $event) {
            $translations = $event->translations ?? [];

            foreach (['ru', 'en', 'az'] as $locale) {
                if (isset($translations[$locale]['slug'])) {
                    unset($translations[$locale]['slug']);
                }
            }

            $event->translations = $translations;
            $event->save();
        }
    }
};
