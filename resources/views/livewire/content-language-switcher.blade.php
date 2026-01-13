<div class="flex items-center gap-2">
    @if($languages->count() > 0)
        <div class="flex items-center gap-1 bg-gray-100 dark:bg-gray-800 rounded-lg p-1">
            @foreach($languages as $language)
                <button
                    wire:click="switchLanguage({{ $language->id }})"
                    class="px-3 py-1.5 text-sm font-medium rounded-md transition-all duration-200
                        {{ $selectedLanguageId == $language->id
                            ? 'bg-primary-600 text-white shadow-sm'
                            : 'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700' }}"
                    title="{{ $language->native_name }}"
                >
                    @if($language->flag)
                        <span class="mr-1">{{ $language->flag }}</span>
                    @endif
                    {{ strtoupper($language->code) }}
                </button>
            @endforeach
        </div>
    @else
        <a href="{{ route('filament.admin.resources.languages.create') }}"
           class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">
            + Добавить язык
        </a>
    @endif
</div>
