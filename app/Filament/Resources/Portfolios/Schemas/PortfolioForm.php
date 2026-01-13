<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use App\Models\Language;
use App\Models\PortfolioCategory;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $contentTabs = [];
        foreach ($languages as $language) {
            $contentTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.title")
                        ->label(__('portfolio.fields.title'))
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, ?string $state, $get) use ($language) {
                            if ($state && !$get("translations.{$language->code}.slug")) {
                                $slug = Str::slug($state);
                                $set("translations.{$language->code}.slug", $slug);
                            }
                        })
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.slug")
                        ->label(__('common.fields.slug'))
                        ->maxLength(255)
                        ->helperText(__('portfolio.fields.slug_helper'))
                        ->columnSpanFull(),
                    Textarea::make("translations.{$language->code}.description")
                        ->label(__('portfolio.fields.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                    RichEditor::make("translations.{$language->code}.content")
                        ->label(__('portfolio.fields.content'))
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('portfolio-images')
                        ->toolbarButtons([
                            'attachFiles',
                            'bold',
                            'italic',
                            'underline',
                            'link',
                            'h2',
                            'h3',
                            'bulletList',
                            'orderedList',
                            'blockquote',
                        ]),
                ]);
        }

        return $schema
            ->columns(1)
            ->components([
                Section::make(__('portfolio.sections.logo'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('client_logo')
                            ->collection('client-logo')
                            ->label(__('portfolio.fields.logo'))
                            ->image()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('common.sections.content_by_languages'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('portfolio.sections.gallery'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('portfolio-gallery')
                            ->label(__('portfolio.fields.gallery'))
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->maxFiles(30)
                            ->image()
                            ->imageEditor()
                            ->maxSize(10240)
                            ->imagePreviewHeight('120')
                            ->panelLayout('grid')
                            ->conversion('thumb')
                            ->columnSpanFull(),
                    ]),

                Section::make(__('portfolio.sections.video'))
                    ->schema([
                        TextInput::make('video_url')
                            ->label(__('portfolio.fields.video_url'))
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText(__('portfolio.fields.video_url_helper'))
                            ->columnSpanFull(),
                    ]),

                Section::make(__('portfolio.sections.links'))
                    ->schema([
                        TextInput::make('website_url')
                            ->label(__('portfolio.fields.website_url'))
                            ->url()
                            ->maxLength(255),
                        Repeater::make('social_links')
                            ->label(__('portfolio.fields.social_links'))
                            ->schema([
                                Select::make('platform')
                                    ->label(__('portfolio.fields.platform'))
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'instagram' => 'Instagram',
                                        'twitter' => 'X (Twitter)',
                                        'linkedin' => 'LinkedIn',
                                        'youtube' => 'YouTube',
                                        'telegram' => 'Telegram',
                                        'behance' => 'Behance',
                                        'dribbble' => 'Dribbble',
                                    ])
                                    ->required(),
                                TextInput::make('url')
                                    ->label(__('portfolio.fields.url'))
                                    ->url()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['platform'] ?? null)
                            ->addActionLabel(__('portfolio.fields.add_link'))
                            ->columnSpanFull(),
                    ]),

                Section::make(__('portfolio.sections.settings'))
                    ->schema([
                        Select::make('portfolio_category_id')
                            ->label(__('portfolio.fields.category'))
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('portfolio.fields.category_name'))
                                    ->required(),
                                TextInput::make('slug')
                                    ->label(__('common.fields.slug'))
                                    ->required(),
                            ]),
                        DatePicker::make('project_date')
                            ->label(__('portfolio.fields.project_date'))
                            ->native(false)
                            ->displayFormat('d.m.Y'),
                        TextInput::make('sort_order')
                            ->label(__('portfolio.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_featured')
                            ->label(__('portfolio.fields.is_featured'))
                            ->default(false),
                        Toggle::make('is_published')
                            ->label(__('portfolio.fields.is_published'))
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }
}
