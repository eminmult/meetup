<?php

namespace App\Filament\Resources\Awards\Schemas;

use App\Models\Language;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class AwardForm
{
    public static function configure(Schema $schema): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $contentTabs = [];
        foreach ($languages as $language) {
            $contentTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.title")
                        ->label(__('awards.fields.title'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.organization")
                        ->label(__('awards.fields.organization'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                ]);
        }

        return $schema
            ->columns(1)
            ->components([
                Section::make(__('awards.sections.content'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('awards.sections.details'))
                    ->schema([
                        TextInput::make('year')
                            ->label(__('awards.fields.year'))
                            ->maxLength(4)
                            ->placeholder('2024'),
                        Select::make('icon')
                            ->label(__('awards.fields.icon'))
                            ->options([
                                'award' => 'Award (Медаль)',
                                'star' => 'Star (Звезда)',
                                'trophy' => 'Trophy (Кубок)',
                                'globe' => 'Globe (Глобус)',
                                'certificate' => 'Certificate (Сертификат)',
                            ])
                            ->default('award')
                            ->searchable(),
                    ])
                    ->columns(2),

                Section::make(__('awards.sections.settings'))
                    ->schema([
                        Toggle::make('is_published')
                            ->label(__('awards.fields.is_published'))
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label(__('awards.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
