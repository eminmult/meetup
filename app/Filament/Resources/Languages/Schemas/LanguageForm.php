<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function getLanguagePresets(): array
    {
        return [
            'az' => ['name' => 'Azerbaijani', 'native_name' => 'Azərbaycan', 'flag' => '🇦🇿'],
            'ru' => ['name' => 'Russian', 'native_name' => 'Русский', 'flag' => '🇷🇺'],
            'en' => ['name' => 'English', 'native_name' => 'English', 'flag' => '🇬🇧'],
            'tr' => ['name' => 'Turkish', 'native_name' => 'Türkçe', 'flag' => '🇹🇷'],
            'de' => ['name' => 'German', 'native_name' => 'Deutsch', 'flag' => '🇩🇪'],
            'fr' => ['name' => 'French', 'native_name' => 'Français', 'flag' => '🇫🇷'],
            'es' => ['name' => 'Spanish', 'native_name' => 'Español', 'flag' => '🇪🇸'],
            'it' => ['name' => 'Italian', 'native_name' => 'Italiano', 'flag' => '🇮🇹'],
            'pt' => ['name' => 'Portuguese', 'native_name' => 'Português', 'flag' => '🇵🇹'],
            'zh' => ['name' => 'Chinese', 'native_name' => '中文', 'flag' => '🇨🇳'],
            'ja' => ['name' => 'Japanese', 'native_name' => '日本語', 'flag' => '🇯🇵'],
            'ko' => ['name' => 'Korean', 'native_name' => '한국어', 'flag' => '🇰🇷'],
            'ar' => ['name' => 'Arabic', 'native_name' => 'العربية', 'flag' => '🇸🇦'],
            'fa' => ['name' => 'Persian', 'native_name' => 'فارسی', 'flag' => '🇮🇷'],
            'he' => ['name' => 'Hebrew', 'native_name' => 'עברית', 'flag' => '🇮🇱'],
            'hi' => ['name' => 'Hindi', 'native_name' => 'हिन्दी', 'flag' => '🇮🇳'],
            'uk' => ['name' => 'Ukrainian', 'native_name' => 'Українська', 'flag' => '🇺🇦'],
            'ka' => ['name' => 'Georgian', 'native_name' => 'ქართული', 'flag' => '🇬🇪'],
            'pl' => ['name' => 'Polish', 'native_name' => 'Polski', 'flag' => '🇵🇱'],
            'nl' => ['name' => 'Dutch', 'native_name' => 'Nederlands', 'flag' => '🇳🇱'],
            'sv' => ['name' => 'Swedish', 'native_name' => 'Svenska', 'flag' => '🇸🇪'],
            'no' => ['name' => 'Norwegian', 'native_name' => 'Norsk', 'flag' => '🇳🇴'],
            'da' => ['name' => 'Danish', 'native_name' => 'Dansk', 'flag' => '🇩🇰'],
            'fi' => ['name' => 'Finnish', 'native_name' => 'Suomi', 'flag' => '🇫🇮'],
            'el' => ['name' => 'Greek', 'native_name' => 'Ελληνικά', 'flag' => '🇬🇷'],
            'cs' => ['name' => 'Czech', 'native_name' => 'Čeština', 'flag' => '🇨🇿'],
            'ro' => ['name' => 'Romanian', 'native_name' => 'Română', 'flag' => '🇷🇴'],
            'hu' => ['name' => 'Hungarian', 'native_name' => 'Magyar', 'flag' => '🇭🇺'],
            'bg' => ['name' => 'Bulgarian', 'native_name' => 'Български', 'flag' => '🇧🇬'],
            'sr' => ['name' => 'Serbian', 'native_name' => 'Српски', 'flag' => '🇷🇸'],
            'hr' => ['name' => 'Croatian', 'native_name' => 'Hrvatski', 'flag' => '🇭🇷'],
            'sk' => ['name' => 'Slovak', 'native_name' => 'Slovenčina', 'flag' => '🇸🇰'],
            'sl' => ['name' => 'Slovenian', 'native_name' => 'Slovenščina', 'flag' => '🇸🇮'],
            'lt' => ['name' => 'Lithuanian', 'native_name' => 'Lietuvių', 'flag' => '🇱🇹'],
            'lv' => ['name' => 'Latvian', 'native_name' => 'Latviešu', 'flag' => '🇱🇻'],
            'et' => ['name' => 'Estonian', 'native_name' => 'Eesti', 'flag' => '🇪🇪'],
            'kk' => ['name' => 'Kazakh', 'native_name' => 'Қазақша', 'flag' => '🇰🇿'],
            'uz' => ['name' => 'Uzbek', 'native_name' => 'Oʻzbek', 'flag' => '🇺🇿'],
            'hy' => ['name' => 'Armenian', 'native_name' => 'Հայերdelays', 'flag' => '🇦🇲'],
            'id' => ['name' => 'Indonesian', 'native_name' => 'Bahasa Indonesia', 'flag' => '🇮🇩'],
            'ms' => ['name' => 'Malay', 'native_name' => 'Bahasa Melayu', 'flag' => '🇲🇾'],
            'th' => ['name' => 'Thai', 'native_name' => 'ไทย', 'flag' => '🇹🇭'],
            'vi' => ['name' => 'Vietnamese', 'native_name' => 'Tiếng Việt', 'flag' => '🇻🇳'],
        ];
    }

    public static function configure(Schema $schema): Schema
    {
        $presets = self::getLanguagePresets();
        $options = [];
        foreach ($presets as $code => $data) {
            $options[$code] = "{$data['flag']} {$data['native_name']} ({$data['name']})";
        }

        return $schema
            ->components([
                Section::make(__('languages.sections.select_language'))
                    ->schema([
                        Select::make('language_preset')
                            ->label(__('languages.fields.language'))
                            ->options($options)
                            ->searchable()
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) use ($presets) {
                                if ($state && isset($presets[$state])) {
                                    $set('code', $state);
                                    $set('name', $presets[$state]['name']);
                                    $set('native_name', $presets[$state]['native_name']);
                                    $set('flag', $presets[$state]['flag']);
                                }
                            })
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ]),
                Section::make(__('languages.sections.language_data'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('code')
                                    ->label(__('languages.fields.code'))
                                    ->required()
                                    ->maxLength(10)
                                    ->unique(ignoreRecord: true),
                                TextInput::make('name')
                                    ->label(__('languages.fields.name'))
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('native_name')
                                    ->label(__('languages.fields.native_name'))
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('flag')
                                    ->label(__('languages.fields.flag'))
                                    ->maxLength(10),
                            ]),
                    ]),
                Section::make(__('languages.sections.settings'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label(__('languages.fields.is_active'))
                                    ->default(true),
                                Toggle::make('is_default')
                                    ->label(__('languages.fields.is_default'))
                                    ->helperText(__('languages.fields.is_default_helper')),
                                TextInput::make('sort_order')
                                    ->label(__('languages.fields.sort_order'))
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }
}
