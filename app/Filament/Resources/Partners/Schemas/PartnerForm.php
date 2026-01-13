<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make(__('partners.sections.logo'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('logo')
                            ->collection('logo')
                            ->label(__('partners.fields.logo'))
                            ->image()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('partners.sections.info'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('partners.fields.name'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('website_url')
                            ->label(__('partners.fields.website_url'))
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make(__('partners.sections.settings'))
                    ->schema([
                        TextInput::make('sort_order')
                            ->label(__('partners.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_published')
                            ->label(__('partners.fields.is_published'))
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
