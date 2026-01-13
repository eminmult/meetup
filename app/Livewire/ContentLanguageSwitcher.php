<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;

class ContentLanguageSwitcher extends Component
{
    public ?int $selectedLanguageId = null;

    public function mount(): void
    {
        $this->selectedLanguageId = session('filament_language_id');

        if (!$this->selectedLanguageId) {
            $defaultLanguage = Language::getDefault();
            if ($defaultLanguage) {
                $this->selectedLanguageId = $defaultLanguage->id;
                session(['filament_language_id' => $this->selectedLanguageId]);
            }
        }
    }

    public function switchLanguage(int $languageId): void
    {
        $this->selectedLanguageId = $languageId;
        session(['filament_language_id' => $languageId]);

        $this->dispatch('language-switched', languageId: $languageId);

        // Refresh the page to apply the filter
        $this->redirect(request()->header('Referer', '/admin'));
    }

    public function render()
    {
        $languages = Language::active()->ordered()->get();

        return view('livewire.content-language-switcher', [
            'languages' => $languages,
        ]);
    }
}
