<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\Language;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $contentTabs = [];
        foreach ($languages as $language) {
            $contentTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.title")
                        ->label(__('common.fields.title'))
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, ?string $state, $get) use ($language) {
                            if ($state && !$get("translations.{$language->code}.slug")) {
                                $cleanState = preg_replace('/[?!.,;:\'"«»""„\(\)\[\]{}]/', '', $state ?? '');
                                $slug = Str::slug($cleanState);
                                $set("translations.{$language->code}.slug", $slug);
                            }
                        })
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.slug")
                        ->label(__('common.fields.slug'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    RichEditor::make("translations.{$language->code}.content")
                        ->label(__('common.fields.description'))
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('service-images')
                        ->fileAttachmentsVisibility('public')
                        ->toolbarButtons([
                            'attachFiles',
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'link',
                            'h2',
                            'h3',
                            'bulletList',
                            'orderedList',
                            'blockquote',
                        ]),
                    Textarea::make("translations.{$language->code}.excerpt")
                        ->label(__('common.fields.excerpt'))
                        ->rows(2)
                        ->maxLength(500)
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.meta_title")
                        ->label(__('common.fields.meta_title'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Textarea::make("translations.{$language->code}.meta_description")
                        ->label(__('common.fields.meta_description'))
                        ->rows(2)
                        ->maxLength(500)
                        ->columnSpanFull(),
                ]);
        }

        return $schema
            ->columns(1)
            ->components([
                Section::make(__('services.sections.content'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('services.sections.pricing'))
                    ->schema([
                        TextInput::make('price')
                            ->label(__('services.fields.price'))
                            ->numeric()
                            ->prefix('₼')
                            ->step(0.01)
                            ->helperText(__('services.fields.price_helper')),
                        TextInput::make('price_text')
                            ->label(__('services.fields.price_text'))
                            ->maxLength(100)
                            ->placeholder(__('services.fields.price_text_placeholder'))
                            ->helperText(__('services.fields.price_text_helper')),
                        TextInput::make('duration')
                            ->label(__('services.fields.duration'))
                            ->maxLength(100)
                            ->placeholder(__('services.fields.duration_placeholder'))
                            ->helperText(__('services.fields.duration_helper')),
                        TextInput::make('icon')
                            ->label(__('services.fields.icon'))
                            ->maxLength(100)
                            ->placeholder(__('services.fields.icon_placeholder'))
                            ->helperText(__('services.fields.icon_helper')),
                    ])
                    ->columns(2),

                Section::make(__('services.sections.gallery'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('service-gallery')
                            ->label(__('services.fields.gallery'))
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->maxFiles(10)
                            ->image()
                            ->imageEditor()
                            ->maxSize(10240)
                            ->imagePreviewHeight('120')
                            ->panelLayout('grid')
                            ->conversion('thumb')
                            ->helperText(__('services.fields.gallery_helper'))
                            ->columnSpanFull()
                            ->live(),
                    ])
                    ->columns(1),

                Section::make(__('services.sections.offers'))
                    ->description(__('services.sections.offers_description'))
                    ->schema([
                        Repeater::make('offers')
                            ->label(__('services.fields.offers'))
                            ->schema([
                                Select::make('icon')
                                    ->label(__('services.fields.offer_icon'))
                                    ->options([
                                        'layers' => 'Layers (Слои)',
                                        'calendar' => 'Calendar (Календарь)',
                                        'star' => 'Star (Звезда)',
                                        'play' => 'Play (Видео)',
                                        'users' => 'Users (Пользователи)',
                                        'briefcase' => 'Briefcase (Портфель)',
                                        'mic' => 'Microphone (Микрофон)',
                                        'camera' => 'Camera (Камера)',
                                        'music' => 'Music (Музыка)',
                                        'gift' => 'Gift (Подарок)',
                                        'heart' => 'Heart (Сердце)',
                                        'map' => 'Map (Карта)',
                                        'truck' => 'Truck (Доставка)',
                                        'settings' => 'Settings (Настройки)',
                                        'zap' => 'Zap (Молния)',
                                        'award' => 'Award (Награда)',
                                    ])
                                    ->searchable()
                                    ->required(),
                                TextInput::make('title_ru')
                                    ->label(__('services.fields.offer_title') . ' (RU)')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('title_en')
                                    ->label(__('services.fields.offer_title') . ' (EN)')
                                    ->maxLength(100),
                                TextInput::make('title_az')
                                    ->label(__('services.fields.offer_title') . ' (AZ)')
                                    ->maxLength(100),
                                Textarea::make('description_ru')
                                    ->label(__('services.fields.offer_description') . ' (RU)')
                                    ->rows(2)
                                    ->required()
                                    ->maxLength(300)
                                    ->columnSpanFull(),
                                Textarea::make('description_en')
                                    ->label(__('services.fields.offer_description') . ' (EN)')
                                    ->rows(2)
                                    ->maxLength(300)
                                    ->columnSpanFull(),
                                Textarea::make('description_az')
                                    ->label(__('services.fields.offer_description') . ' (AZ)')
                                    ->rows(2)
                                    ->maxLength(300)
                                    ->columnSpanFull(),
                            ])
                            ->columns(4)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title_ru'] ?? 'Новое предложение')
                            ->addActionLabel(__('services.fields.add_offer'))
                            ->defaultItems(0)
                            ->maxItems(8)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make(__('services.sections.process'))
                    ->description(__('services.sections.process_description'))
                    ->schema([
                        Repeater::make('process')
                            ->label(__('services.fields.process'))
                            ->schema([
                                TextInput::make('title_ru')
                                    ->label(__('services.fields.process_title') . ' (RU)')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('title_en')
                                    ->label(__('services.fields.process_title') . ' (EN)')
                                    ->maxLength(100),
                                TextInput::make('title_az')
                                    ->label(__('services.fields.process_title') . ' (AZ)')
                                    ->maxLength(100),
                                Textarea::make('description_ru')
                                    ->label(__('services.fields.process_description') . ' (RU)')
                                    ->rows(2)
                                    ->required()
                                    ->maxLength(300)
                                    ->columnSpanFull(),
                                Textarea::make('description_en')
                                    ->label(__('services.fields.process_description') . ' (EN)')
                                    ->rows(2)
                                    ->maxLength(300)
                                    ->columnSpanFull(),
                                Textarea::make('description_az')
                                    ->label(__('services.fields.process_description') . ' (AZ)')
                                    ->rows(2)
                                    ->maxLength(300)
                                    ->columnSpanFull(),
                            ])
                            ->columns(3)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title_ru'] ?? 'Новый этап')
                            ->addActionLabel(__('services.fields.add_process'))
                            ->defaultItems(0)
                            ->maxItems(10)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make(__('services.sections.pricing_packages'))
                    ->description(__('services.sections.pricing_packages_description'))
                    ->schema([
                        Repeater::make('pricing')
                            ->label(__('services.fields.pricing'))
                            ->schema([
                                TextInput::make('name_ru')
                                    ->label(__('services.fields.package_name') . ' (RU)')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('name_en')
                                    ->label(__('services.fields.package_name') . ' (EN)')
                                    ->maxLength(100),
                                TextInput::make('name_az')
                                    ->label(__('services.fields.package_name') . ' (AZ)')
                                    ->maxLength(100),
                                TextInput::make('guests_ru')
                                    ->label(__('services.fields.package_guests') . ' (RU)')
                                    ->maxLength(50)
                                    ->placeholder('До 50 гостей'),
                                TextInput::make('guests_en')
                                    ->label(__('services.fields.package_guests') . ' (EN)')
                                    ->maxLength(50),
                                TextInput::make('guests_az')
                                    ->label(__('services.fields.package_guests') . ' (AZ)')
                                    ->maxLength(50),
                                TextInput::make('price')
                                    ->label(__('services.fields.package_price'))
                                    ->required()
                                    ->maxLength(50)
                                    ->placeholder('2000'),
                                Toggle::make('is_featured')
                                    ->label(__('services.fields.package_featured'))
                                    ->default(false),
                                Textarea::make('features_ru')
                                    ->label(__('services.fields.package_features') . ' (RU)')
                                    ->rows(4)
                                    ->required()
                                    ->helperText(__('services.fields.package_features_helper'))
                                    ->columnSpanFull(),
                                Textarea::make('features_en')
                                    ->label(__('services.fields.package_features') . ' (EN)')
                                    ->rows(4)
                                    ->columnSpanFull(),
                                Textarea::make('features_az')
                                    ->label(__('services.fields.package_features') . ' (AZ)')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->columns(4)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name_ru'] ?? 'Новый пакет')
                            ->addActionLabel(__('services.fields.add_package'))
                            ->defaultItems(0)
                            ->maxItems(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make(__('services.sections.faq'))
                    ->description(__('services.sections.faq_description'))
                    ->schema([
                        Repeater::make('faq')
                            ->label(__('services.fields.faq'))
                            ->schema([
                                TextInput::make('question_ru')
                                    ->label(__('services.fields.faq_question') . ' (RU)')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                TextInput::make('question_en')
                                    ->label(__('services.fields.faq_question') . ' (EN)')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                TextInput::make('question_az')
                                    ->label(__('services.fields.faq_question') . ' (AZ)')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Textarea::make('answer_ru')
                                    ->label(__('services.fields.faq_answer') . ' (RU)')
                                    ->rows(3)
                                    ->required()
                                    ->maxLength(1000)
                                    ->columnSpanFull(),
                                Textarea::make('answer_en')
                                    ->label(__('services.fields.faq_answer') . ' (EN)')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->columnSpanFull(),
                                Textarea::make('answer_az')
                                    ->label(__('services.fields.faq_answer') . ' (AZ)')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['question_ru'] ?? 'Новый вопрос')
                            ->addActionLabel(__('services.fields.add_faq'))
                            ->defaultItems(0)
                            ->maxItems(10)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make(__('services.sections.settings'))
                    ->schema([
                        Toggle::make('is_published')
                            ->label(__('services.fields.is_published'))
                            ->default(true)
                            ->helperText(__('services.fields.is_published_helper'))
                            ->columnSpanFull(),
                        Toggle::make('is_featured')
                            ->label(__('services.fields.is_featured'))
                            ->default(false)
                            ->helperText(__('services.fields.is_featured_helper'))
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label(__('services.fields.sort_order'))
                            ->numeric()
                            ->default(0)
                            ->helperText(__('services.fields.sort_order_helper')),
                    ]),
            ]);
    }
}
