<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Models\Language;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $contentTabs = [];
        foreach ($languages as $language) {
            $contentTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.author_name")
                        ->label(__('testimonials.fields.author_name'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.author_position")
                        ->label(__('testimonials.fields.author_position'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Textarea::make("translations.{$language->code}.text")
                        ->label(__('testimonials.fields.text'))
                        ->rows(4)
                        ->columnSpanFull(),
                ]);
        }

        return $schema
            ->columns(1)
            ->components([
                Section::make(__('testimonials.sections.avatar'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->label(__('testimonials.fields.avatar'))
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->maxSize(5120)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('common.sections.content_by_languages'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('testimonials.sections.settings'))
                    ->schema([
                        TextInput::make('sort_order')
                            ->label(__('testimonials.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_published')
                            ->label(__('testimonials.fields.is_published'))
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
