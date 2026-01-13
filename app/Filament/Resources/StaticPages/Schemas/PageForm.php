<?php

namespace App\Filament\Resources\StaticPages\Schemas;

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

class PageForm
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
                            if ($state && !$get('slug')) {
                                $cleanState = preg_replace('/[?!.,;:\'\"«»""„\(\)\[\]{}]/', '', $state ?? '');
                                $slug = Str::slug($cleanState);
                                $set('slug', $slug);
                            }
                        })
                        ->columnSpanFull(),
                    RichEditor::make("translations.{$language->code}.content")
                        ->label(__('common.fields.content'))
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('page-images')
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
                Section::make(__('pages.sections.content'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('pages.sections.gallery'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('page-gallery')
                            ->label(__('pages.fields.gallery'))
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
                            ->helperText(__('pages.fields.gallery_helper'))
                            ->columnSpanFull()
                            ->live(),
                    ])
                    ->columns(1)
                    ->visible(fn ($get) => $get('template') !== 'about'),

                // About page specific sections
                ...self::aboutPageSections($languages),

                // Contact page specific sections
                ...self::contactPageSections($languages),

                // Home page specific sections
                ...self::homePageSections($languages),

                // Team page specific sections
                ...self::teamPageSections($languages),

                // Services page specific sections
                ...self::servicesPageSections($languages),

                // Portfolio page specific sections
                ...self::portfolioPageSections($languages),

                // Blog page specific sections
                ...self::blogPageSections($languages),

                // Events page specific sections
                ...self::eventsPageSections($languages),

                Section::make(__('pages.sections.settings'))
                    ->schema([
                        TextInput::make('slug')
                            ->label(__('pages.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText(__('pages.fields.slug_helper')),
                        Select::make('template')
                            ->label(__('pages.fields.template'))
                            ->options([
                                'default' => __('pages.templates.default'),
                                'home' => __('pages.templates.home'),
                                'contact' => __('pages.templates.contact'),
                                'about' => __('pages.templates.about'),
                                'team-page' => __('pages.templates.team-page'),
                                'team-detail' => __('pages.templates.team-detail'),
                                'services-page' => __('pages.templates.services-page'),
                                'service-detail' => __('pages.templates.service-detail'),
                                'portfolio-page' => __('pages.templates.portfolio-page'),
                                'portfolio-detail' => __('pages.templates.portfolio-detail'),
                                'blog-page' => __('pages.templates.blog-page'),
                                'blog-detail' => __('pages.templates.blog-detail'),
                                'events-page' => __('pages.templates.events-page'),
                                'event-detail' => __('pages.templates.event-detail'),
                                'full-width' => __('pages.templates.full-width'),
                            ])
                            ->default('default')
                            ->helperText(__('pages.fields.template_helper')),
                        Toggle::make('is_published')
                            ->label(__('pages.fields.is_published'))
                            ->default(true)
                            ->helperText(__('pages.fields.is_published_helper'))
                            ->columnSpanFull(),
                        Toggle::make('show_in_menu')
                            ->label(__('pages.fields.show_in_menu'))
                            ->default(false)
                            ->helperText(__('pages.fields.show_in_menu_helper'))
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label(__('pages.fields.sort_order'))
                            ->numeric()
                            ->default(0)
                            ->helperText(__('pages.fields.sort_order_helper')),
                    ])
                    ->columns(2),
            ]);
    }

    private static function aboutPageSections($languages): array
    {
        // Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(3),
                    TextInput::make("translations.{$language->code}.video_btn")
                        ->label(__('static_pages.fields.video_btn')),
                    TextInput::make("translations.{$language->code}.scroll_text")
                        ->label(__('static_pages.fields.scroll_text')),
                ]);
        }

        // Story tabs
        $storyTabs = [];
        foreach ($languages as $language) {
            $storyTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.story.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.story.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.story.{$language->code}.text_1")
                        ->label(__('static_pages.fields.text') . ' 1')
                        ->rows(3),
                    Textarea::make("sections.story.{$language->code}.text_2")
                        ->label(__('static_pages.fields.text') . ' 2')
                        ->rows(3),
                ]);
        }

        // Mission tabs
        $missionTabs = [];
        foreach ($languages as $language) {
            $missionTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.mission.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.mission.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.mission.{$language->code}.mission_title")
                        ->label(__('static_pages.fields.mission_title')),
                    Textarea::make("sections.mission.{$language->code}.mission_text")
                        ->label(__('static_pages.fields.mission_text'))
                        ->rows(2),
                    TextInput::make("sections.mission.{$language->code}.vision_title")
                        ->label(__('static_pages.fields.vision_title')),
                    Textarea::make("sections.mission.{$language->code}.vision_text")
                        ->label(__('static_pages.fields.vision_text'))
                        ->rows(2),
                    TextInput::make("sections.mission.{$language->code}.goal_title")
                        ->label(__('static_pages.fields.goal_title')),
                    Textarea::make("sections.mission.{$language->code}.goal_text")
                        ->label(__('static_pages.fields.goal_text'))
                        ->rows(2),
                ]);
        }

        // Values header tabs
        $valuesTabs = [];
        foreach ($languages as $language) {
            $valuesTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.values.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.values.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // Gallery header tabs
        $galleryTabs = [];
        foreach ($languages as $language) {
            $galleryTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.gallery.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.gallery.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // Timeline header tabs
        $timelineTabs = [];
        foreach ($languages as $language) {
            $timelineTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.timeline.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.timeline.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // CTA tabs
        $ctaTabs = [];
        foreach ($languages as $language) {
            $ctaTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.cta.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.cta.{$language->code}.text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                    TextInput::make("sections.cta.{$language->code}.btn_text")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        return [
            Section::make(__('static_pages.sections.hero'))
                ->description(__('static_pages.sections.hero_desc'))
                ->schema([
                    TextInput::make('sections.hero.video_url')
                        ->label(__('static_pages.fields.video_url'))
                        ->url()
                        ->placeholder('https://youtube.com/watch?v=...')
                        ->columnSpanFull(),
                    Tabs::make('HeroTranslations')
                        ->tabs($heroTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),

            Section::make(__('static_pages.sections.story'))
                ->description(__('static_pages.sections.story_desc'))
                ->schema([
                    TextInput::make('sections.story.year')
                        ->label(__('static_pages.fields.year'))
                        ->numeric()
                        ->placeholder('2018'),
                    Tabs::make('StoryTranslations')
                        ->tabs($storyTabs)
                        ->columnSpanFull(),
                    Repeater::make('sections.story.highlights')
                        ->label(__('static_pages.fields.highlights'))
                        ->schema([
                            Select::make('icon')
                                ->label(__('static_pages.fields.icon'))
                                ->options([
                                    'users' => __('static_pages.icons.users'),
                                    'layers' => __('static_pages.icons.layers'),
                                    'award' => __('static_pages.icons.award'),
                                    'heart' => __('static_pages.icons.heart'),
                                ])
                                ->required(),
                            TextInput::make('number')
                                ->label(__('static_pages.fields.number'))
                                ->placeholder('25+')
                                ->required(),
                            TextInput::make('label_ru')
                                ->label(__('static_pages.fields.label') . ' (RU)')
                                ->required(),
                            TextInput::make('label_en')
                                ->label(__('static_pages.fields.label') . ' (EN)'),
                            TextInput::make('label_az')
                                ->label(__('static_pages.fields.label') . ' (AZ)'),
                            TextInput::make('sublabel_ru')
                                ->label(__('static_pages.fields.sublabel') . ' (RU)'),
                            TextInput::make('sublabel_en')
                                ->label(__('static_pages.fields.sublabel') . ' (EN)'),
                            TextInput::make('sublabel_az')
                                ->label(__('static_pages.fields.sublabel') . ' (AZ)'),
                        ])
                        ->columns(4)
                        ->reorderable()
                        ->collapsible()
                        ->maxItems(4)
                        ->itemLabel(fn (array $state): ?string => ($state['number'] ?? '') . ' ' . ($state['label_ru'] ?? ''))
                        ->addActionLabel(__('static_pages.fields.add_highlight'))
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),

            Section::make(__('static_pages.sections.mission'))
                ->description(__('static_pages.sections.mission_desc'))
                ->schema([
                    Tabs::make('MissionTranslations')
                        ->tabs($missionTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),

            Section::make(__('static_pages.sections.values'))
                ->description(__('static_pages.sections.values_desc'))
                ->schema([
                    Tabs::make('ValuesTranslations')
                        ->tabs($valuesTabs)
                        ->columnSpanFull(),
                    Repeater::make('sections.values.items')
                        ->label(__('static_pages.fields.values'))
                        ->schema([
                            TextInput::make('title_ru')
                                ->label(__('static_pages.fields.title') . ' (RU)')
                                ->required(),
                            TextInput::make('title_en')
                                ->label(__('static_pages.fields.title') . ' (EN)'),
                            TextInput::make('title_az')
                                ->label(__('static_pages.fields.title') . ' (AZ)'),
                            Textarea::make('text_ru')
                                ->label(__('static_pages.fields.text') . ' (RU)')
                                ->rows(2),
                            Textarea::make('text_en')
                                ->label(__('static_pages.fields.text') . ' (EN)')
                                ->rows(2),
                            Textarea::make('text_az')
                                ->label(__('static_pages.fields.text') . ' (AZ)')
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->reorderable()
                        ->collapsible()
                        ->maxItems(6)
                        ->itemLabel(fn (array $state): ?string => $state['title_ru'] ?? null)
                        ->addActionLabel(__('static_pages.fields.add_value'))
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),

            Section::make(__('static_pages.sections.gallery'))
                ->description(__('static_pages.sections.gallery_desc'))
                ->schema([
                    Tabs::make('GalleryTranslations')
                        ->tabs($galleryTabs)
                        ->columnSpanFull(),
                    Repeater::make('sections.gallery.items')
                        ->label(__('static_pages.fields.gallery_items'))
                        ->schema([
                            TextInput::make('image_url')
                                ->label(__('static_pages.fields.image_url'))
                                ->url()
                                ->required(),
                            TextInput::make('caption_ru')
                                ->label(__('static_pages.fields.caption') . ' (RU)'),
                            TextInput::make('caption_en')
                                ->label(__('static_pages.fields.caption') . ' (EN)'),
                            TextInput::make('caption_az')
                                ->label(__('static_pages.fields.caption') . ' (AZ)'),
                        ])
                        ->columns(4)
                        ->reorderable()
                        ->collapsible()
                        ->maxItems(12)
                        ->itemLabel(fn (array $state): ?string => $state['caption_ru'] ?? 'Изображение')
                        ->addActionLabel(__('static_pages.fields.add_gallery_item'))
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),

            Section::make(__('static_pages.sections.timeline'))
                ->description(__('static_pages.sections.timeline_desc'))
                ->schema([
                    Tabs::make('TimelineTranslations')
                        ->tabs($timelineTabs)
                        ->columnSpanFull(),
                    Repeater::make('sections.timeline.items')
                        ->label(__('static_pages.fields.timeline_items'))
                        ->schema([
                            TextInput::make('year')
                                ->label(__('static_pages.fields.year'))
                                ->required(),
                            TextInput::make('title_ru')
                                ->label(__('static_pages.fields.title') . ' (RU)')
                                ->required(),
                            TextInput::make('title_en')
                                ->label(__('static_pages.fields.title') . ' (EN)'),
                            TextInput::make('title_az')
                                ->label(__('static_pages.fields.title') . ' (AZ)'),
                            Textarea::make('text_ru')
                                ->label(__('static_pages.fields.text') . ' (RU)')
                                ->rows(2),
                            Textarea::make('text_en')
                                ->label(__('static_pages.fields.text') . ' (EN)')
                                ->rows(2),
                            Textarea::make('text_az')
                                ->label(__('static_pages.fields.text') . ' (AZ)')
                                ->rows(2),
                        ])
                        ->columns(4)
                        ->reorderable()
                        ->collapsible()
                        ->maxItems(10)
                        ->itemLabel(fn (array $state): ?string => ($state['year'] ?? '') . ' - ' . ($state['title_ru'] ?? ''))
                        ->addActionLabel(__('static_pages.fields.add_timeline_item'))
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),

            Section::make(__('static_pages.sections.cta'))
                ->schema([
                    Tabs::make('CTATranslations')
                        ->tabs($ctaTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'about')
                ->collapsed(),
        ];
    }

    private static function contactPageSections($languages): array
    {
        // Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                ]);
        }

        // Form section tabs
        $formTabs = [];
        foreach ($languages as $language) {
            $formTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.form.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.form.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.form.{$language->code}.name_label")
                        ->label(__('contact.fields.name_label')),
                    TextInput::make("sections.form.{$language->code}.phone_label")
                        ->label(__('contact.fields.phone_label')),
                    TextInput::make("sections.form.{$language->code}.email_label")
                        ->label(__('contact.fields.email_label')),
                    TextInput::make("sections.form.{$language->code}.service_label")
                        ->label(__('contact.fields.service_label')),
                    TextInput::make("sections.form.{$language->code}.message_label")
                        ->label(__('contact.fields.message_label')),
                    TextInput::make("sections.form.{$language->code}.submit_btn")
                        ->label(__('contact.fields.submit_btn')),
                ]);
        }

        // Contact info tabs
        $infoTabs = [];
        foreach ($languages as $language) {
            $infoTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.info.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.info.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.info.{$language->code}.phone_title")
                        ->label(__('contact.fields.phone_title')),
                    TextInput::make("sections.info.{$language->code}.email_title")
                        ->label(__('contact.fields.email_title')),
                    TextInput::make("sections.info.{$language->code}.address_title")
                        ->label(__('contact.fields.address_title')),
                    Textarea::make("sections.info.{$language->code}.address")
                        ->label(__('contact.fields.address'))
                        ->rows(2),
                    TextInput::make("sections.info.{$language->code}.hours_title")
                        ->label(__('contact.fields.hours_title')),
                    Textarea::make("sections.info.{$language->code}.hours")
                        ->label(__('contact.fields.hours'))
                        ->rows(2),
                    TextInput::make("sections.info.{$language->code}.social_title")
                        ->label(__('contact.fields.social_title')),
                ]);
        }

        // Map tabs
        $mapTabs = [];
        foreach ($languages as $language) {
            $mapTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.map.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.map.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.map.{$language->code}.office_name")
                        ->label(__('contact.fields.office_name')),
                    Textarea::make("sections.map.{$language->code}.office_address")
                        ->label(__('contact.fields.office_address'))
                        ->rows(2),
                    TextInput::make("sections.map.{$language->code}.map_link_text")
                        ->label(__('contact.fields.map_link_text')),
                ]);
        }

        // FAQ tabs
        $faqTabs = [];
        foreach ($languages as $language) {
            $faqTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.faq.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.faq.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        return [
            Section::make(__('contact.sections.hero'))
                ->schema([
                    Tabs::make('ContactHeroTranslations')
                        ->tabs($heroTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'contact')
                ->collapsed(),

            Section::make(__('contact.sections.form'))
                ->description(__('contact.sections.form_desc'))
                ->schema([
                    Tabs::make('ContactFormTranslations')
                        ->tabs($formTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'contact')
                ->collapsed(),

            Section::make(__('contact.sections.info'))
                ->description(__('contact.sections.info_desc'))
                ->schema([
                    TextInput::make('sections.info.phone_1')
                        ->label(__('contact.fields.phone') . ' 1')
                        ->tel(),
                    TextInput::make('sections.info.phone_2')
                        ->label(__('contact.fields.phone') . ' 2')
                        ->tel(),
                    TextInput::make('sections.info.email_1')
                        ->label(__('contact.fields.email') . ' 1')
                        ->email(),
                    TextInput::make('sections.info.email_2')
                        ->label(__('contact.fields.email') . ' 2')
                        ->email(),
                    Tabs::make('ContactInfoTranslations')
                        ->tabs($infoTabs)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->visible(fn ($get) => $get('template') === 'contact')
                ->collapsed(),

            Section::make(__('contact.sections.social'))
                ->schema([
                    TextInput::make('sections.social.instagram')
                        ->label('Instagram')
                        ->url(),
                    TextInput::make('sections.social.facebook')
                        ->label('Facebook')
                        ->url(),
                    TextInput::make('sections.social.linkedin')
                        ->label('LinkedIn')
                        ->url(),
                    TextInput::make('sections.social.youtube')
                        ->label('YouTube')
                        ->url(),
                    TextInput::make('sections.social.whatsapp')
                        ->label('WhatsApp')
                        ->url(),
                    TextInput::make('sections.social.telegram')
                        ->label('Telegram')
                        ->url(),
                ])
                ->columns(3)
                ->visible(fn ($get) => $get('template') === 'contact')
                ->collapsed(),

            Section::make(__('contact.sections.map'))
                ->schema([
                    TextInput::make('sections.map.embed_url')
                        ->label(__('contact.fields.map_embed'))
                        ->url()
                        ->columnSpanFull(),
                    TextInput::make('sections.map.google_maps_link')
                        ->label(__('contact.fields.google_maps_link'))
                        ->url()
                        ->columnSpanFull(),
                    Tabs::make('ContactMapTranslations')
                        ->tabs($mapTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'contact')
                ->collapsed(),

            Section::make(__('contact.sections.faq'))
                ->description(__('contact.sections.faq_desc'))
                ->schema([
                    Tabs::make('ContactFaqTranslations')
                        ->tabs($faqTabs)
                        ->columnSpanFull(),
                    Repeater::make('sections.faq.items')
                        ->label(__('contact.fields.faq_items'))
                        ->schema([
                            TextInput::make('question_ru')
                                ->label(__('contact.fields.question') . ' (RU)')
                                ->required(),
                            TextInput::make('question_en')
                                ->label(__('contact.fields.question') . ' (EN)'),
                            TextInput::make('question_az')
                                ->label(__('contact.fields.question') . ' (AZ)'),
                            Textarea::make('answer_ru')
                                ->label(__('contact.fields.answer') . ' (RU)')
                                ->rows(2)
                                ->required(),
                            Textarea::make('answer_en')
                                ->label(__('contact.fields.answer') . ' (EN)')
                                ->rows(2),
                            Textarea::make('answer_az')
                                ->label(__('contact.fields.answer') . ' (AZ)')
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->reorderable()
                        ->collapsible()
                        ->maxItems(10)
                        ->itemLabel(fn (array $state): ?string => $state['question_ru'] ?? null)
                        ->addActionLabel(__('contact.fields.add_faq'))
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'contact')
                ->collapsed(),
        ];
    }

    private static function homePageSections($languages): array
    {
        // Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_description")
                        ->label(__('static_pages.fields.description'))
                        ->rows(2),
                    TextInput::make("translations.{$language->code}.hero_cta_primary")
                        ->label(__('home.fields.cta_primary')),
                    TextInput::make("translations.{$language->code}.hero_cta_secondary")
                        ->label(__('home.fields.cta_secondary')),
                    TextInput::make("translations.{$language->code}.hero_scroll")
                        ->label(__('home.fields.scroll_text')),
                ]);
        }

        // About section tabs
        $aboutTabs = [];
        foreach ($languages as $language) {
            $aboutTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.about.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.about.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.about.{$language->code}.text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(3),
                    TextInput::make("sections.about.{$language->code}.years_label")
                        ->label(__('home.fields.years_label')),
                    TextInput::make("sections.about.{$language->code}.feature_1")
                        ->label(__('home.fields.feature') . ' 1'),
                    TextInput::make("sections.about.{$language->code}.feature_2")
                        ->label(__('home.fields.feature') . ' 2'),
                    TextInput::make("sections.about.{$language->code}.feature_3")
                        ->label(__('home.fields.feature') . ' 3'),
                    TextInput::make("sections.about.{$language->code}.feature_4")
                        ->label(__('home.fields.feature') . ' 4'),
                    TextInput::make("sections.about.{$language->code}.learn_more")
                        ->label(__('home.fields.learn_more_btn')),
                ]);
        }

        // Partners tabs
        $partnersTabs = [];
        foreach ($languages as $language) {
            $partnersTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.partners.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // Team section tabs
        $teamTabs = [];
        foreach ($languages as $language) {
            $teamTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.team.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.team.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.team.{$language->code}.description")
                        ->label(__('static_pages.fields.description'))
                        ->rows(2),
                ]);
        }

        // Services section tabs
        $servicesTabs = [];
        foreach ($languages as $language) {
            $servicesTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.services.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.services.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.services.{$language->code}.description")
                        ->label(__('static_pages.fields.description'))
                        ->rows(2),
                ]);
        }

        // Portfolio section tabs
        $portfolioTabs = [];
        foreach ($languages as $language) {
            $portfolioTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.portfolio.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.portfolio.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // Stats section tabs
        $statsTabs = [];
        foreach ($languages as $language) {
            $statsTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.stats.{$language->code}.events_label")
                        ->label(__('home.fields.stats_events')),
                    TextInput::make("sections.stats.{$language->code}.guests_label")
                        ->label(__('home.fields.stats_guests')),
                    TextInput::make("sections.stats.{$language->code}.years_label")
                        ->label(__('home.fields.stats_years')),
                    TextInput::make("sections.stats.{$language->code}.team_label")
                        ->label(__('home.fields.stats_team')),
                ]);
        }

        // Community/Events section tabs
        $communityTabs = [];
        foreach ($languages as $language) {
            $communityTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.community.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.community.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.community.{$language->code}.description")
                        ->label(__('static_pages.fields.description'))
                        ->rows(2),
                ]);
        }

        // Testimonials section tabs
        $testimonialsTabs = [];
        foreach ($languages as $language) {
            $testimonialsTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.testimonials.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.testimonials.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // CTA section tabs
        $ctaTabs = [];
        foreach ($languages as $language) {
            $ctaTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.cta.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.cta.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.cta.{$language->code}.description")
                        ->label(__('static_pages.fields.description'))
                        ->rows(2),
                    TextInput::make("sections.cta.{$language->code}.button")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Contact section tabs
        $contactTabs = [];
        foreach ($languages as $language) {
            $contactTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.contact.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.contact.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.contact.{$language->code}.description")
                        ->label(__('static_pages.fields.description'))
                        ->rows(2),
                    TextInput::make("sections.contact.{$language->code}.address_label")
                        ->label(__('contact.fields.address_title')),
                    Textarea::make("sections.contact.{$language->code}.address")
                        ->label(__('contact.fields.address'))
                        ->rows(2),
                    TextInput::make("sections.contact.{$language->code}.phone_label")
                        ->label(__('contact.fields.phone_title')),
                    TextInput::make("sections.contact.{$language->code}.email_label")
                        ->label(__('contact.fields.email_title')),
                    TextInput::make("sections.contact.{$language->code}.form_name")
                        ->label(__('contact.fields.name_label')),
                    TextInput::make("sections.contact.{$language->code}.form_name_placeholder")
                        ->label(__('home.fields.name_placeholder')),
                    TextInput::make("sections.contact.{$language->code}.form_phone")
                        ->label(__('contact.fields.phone_label')),
                    TextInput::make("sections.contact.{$language->code}.form_email")
                        ->label(__('contact.fields.email_label')),
                    TextInput::make("sections.contact.{$language->code}.form_event_type")
                        ->label(__('home.fields.event_type_label')),
                    TextInput::make("sections.contact.{$language->code}.form_event_placeholder")
                        ->label(__('home.fields.event_type_placeholder')),
                    TextInput::make("sections.contact.{$language->code}.form_event_corporate")
                        ->label(__('home.fields.event_corporate')),
                    TextInput::make("sections.contact.{$language->code}.form_event_wedding")
                        ->label(__('home.fields.event_wedding')),
                    TextInput::make("sections.contact.{$language->code}.form_event_birthday")
                        ->label(__('home.fields.event_birthday')),
                    TextInput::make("sections.contact.{$language->code}.form_event_conference")
                        ->label(__('home.fields.event_conference')),
                    TextInput::make("sections.contact.{$language->code}.form_event_networking")
                        ->label(__('home.fields.event_networking')),
                    TextInput::make("sections.contact.{$language->code}.form_event_other")
                        ->label(__('home.fields.event_other')),
                    TextInput::make("sections.contact.{$language->code}.form_message")
                        ->label(__('contact.fields.message_label')),
                    TextInput::make("sections.contact.{$language->code}.form_message_placeholder")
                        ->label(__('home.fields.message_placeholder')),
                    TextInput::make("sections.contact.{$language->code}.form_submit")
                        ->label(__('contact.fields.submit_btn')),
                ]);
        }

        return [
            Section::make(__('home.sections.hero'))
                ->description(__('home.sections.hero_desc'))
                ->schema([
                    Tabs::make('HomeHeroTranslations')
                        ->tabs($heroTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.about'))
                ->description(__('home.sections.about_desc'))
                ->schema([
                    TextInput::make('sections.about.years_number')
                        ->label(__('home.fields.years_number'))
                        ->numeric()
                        ->placeholder('7'),
                    Tabs::make('HomeAboutTranslations')
                        ->tabs($aboutTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.partners'))
                ->description(__('home.sections.partners_desc'))
                ->schema([
                    Tabs::make('HomePartnersTranslations')
                        ->tabs($partnersTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.team'))
                ->description(__('home.sections.team_desc'))
                ->schema([
                    Tabs::make('HomeTeamTranslations')
                        ->tabs($teamTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.services'))
                ->description(__('home.sections.services_desc'))
                ->schema([
                    Tabs::make('HomeServicesTranslations')
                        ->tabs($servicesTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.portfolio'))
                ->description(__('home.sections.portfolio_desc'))
                ->schema([
                    Tabs::make('HomePortfolioTranslations')
                        ->tabs($portfolioTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.stats'))
                ->description(__('home.sections.stats_desc'))
                ->schema([
                    TextInput::make('sections.stats.events_number')
                        ->label(__('home.fields.stats_events_number'))
                        ->numeric()
                        ->placeholder('500'),
                    TextInput::make('sections.stats.guests_number')
                        ->label(__('home.fields.stats_guests_number'))
                        ->numeric()
                        ->placeholder('50'),
                    TextInput::make('sections.stats.years_number')
                        ->label(__('home.fields.stats_years_number'))
                        ->numeric()
                        ->placeholder('7'),
                    TextInput::make('sections.stats.team_number')
                        ->label(__('home.fields.stats_team_number'))
                        ->numeric()
                        ->placeholder('25'),
                    Tabs::make('HomeStatsTranslations')
                        ->tabs($statsTabs)
                        ->columnSpanFull(),
                ])
                ->columns(4)
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.community'))
                ->description(__('home.sections.community_desc'))
                ->schema([
                    Tabs::make('HomeCommunityTranslations')
                        ->tabs($communityTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.testimonials'))
                ->description(__('home.sections.testimonials_desc'))
                ->schema([
                    Tabs::make('HomeTestimonialsTranslations')
                        ->tabs($testimonialsTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.cta'))
                ->description(__('home.sections.cta_desc'))
                ->schema([
                    Tabs::make('HomeCTATranslations')
                        ->tabs($ctaTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),

            Section::make(__('home.sections.contact'))
                ->description(__('home.sections.contact_desc'))
                ->schema([
                    TextInput::make('sections.contact.phone')
                        ->label(__('contact.fields.phone'))
                        ->tel(),
                    TextInput::make('sections.contact.email')
                        ->label(__('contact.fields.email'))
                        ->email(),
                    TextInput::make('sections.contact.instagram')
                        ->label('Instagram')
                        ->url(),
                    TextInput::make('sections.contact.facebook')
                        ->label('Facebook')
                        ->url(),
                    TextInput::make('sections.contact.linkedin')
                        ->label('LinkedIn')
                        ->url(),
                    TextInput::make('sections.contact.whatsapp')
                        ->label('WhatsApp')
                        ->url(),
                    Tabs::make('HomeContactTranslations')
                        ->tabs($contactTabs)
                        ->columnSpanFull(),
                ])
                ->columns(3)
                ->visible(fn ($get) => $get('template') === 'home')
                ->collapsed(),
        ];
    }

    private static function teamPageSections($languages): array
    {
        // Team Page Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                    TextInput::make("translations.{$language->code}.hero_btn")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Leadership section tabs
        $leadershipTabs = [];
        foreach ($languages as $language) {
            $leadershipTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.leadership.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.leadership.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // Team section tabs
        $teamSectionTabs = [];
        foreach ($languages as $language) {
            $teamSectionTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.team.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.team.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                ]);
        }

        // Values section tabs
        $valuesTabs = [];
        foreach ($languages as $language) {
            $valuesTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.values.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.values.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.values.{$language->code}.value_1_title")
                        ->label(__('team_page.fields.value_title') . ' 1'),
                    Textarea::make("sections.values.{$language->code}.value_1_text")
                        ->label(__('team_page.fields.value_text') . ' 1')
                        ->rows(2),
                    TextInput::make("sections.values.{$language->code}.value_2_title")
                        ->label(__('team_page.fields.value_title') . ' 2'),
                    Textarea::make("sections.values.{$language->code}.value_2_text")
                        ->label(__('team_page.fields.value_text') . ' 2')
                        ->rows(2),
                    TextInput::make("sections.values.{$language->code}.value_3_title")
                        ->label(__('team_page.fields.value_title') . ' 3'),
                    Textarea::make("sections.values.{$language->code}.value_3_text")
                        ->label(__('team_page.fields.value_text') . ' 3')
                        ->rows(2),
                ]);
        }

        // Join section tabs
        $joinTabs = [];
        foreach ($languages as $language) {
            $joinTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.join.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.join.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.join.{$language->code}.text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                    TextInput::make("sections.join.{$language->code}.benefit_1")
                        ->label(__('team_page.fields.benefit') . ' 1'),
                    TextInput::make("sections.join.{$language->code}.benefit_2")
                        ->label(__('team_page.fields.benefit') . ' 2'),
                    TextInput::make("sections.join.{$language->code}.benefit_3")
                        ->label(__('team_page.fields.benefit') . ' 3'),
                    TextInput::make("sections.join.{$language->code}.benefit_4")
                        ->label(__('team_page.fields.benefit') . ' 4'),
                    TextInput::make("sections.join.{$language->code}.btn_text")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // CTA section tabs
        $ctaTabs = [];
        foreach ($languages as $language) {
            $ctaTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.cta.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.cta.{$language->code}.text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                    TextInput::make("sections.cta.{$language->code}.btn_text")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Team Detail - Section labels tabs
        $detailLabelsTabs = [];
        foreach ($languages as $language) {
            $detailLabelsTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.labels.{$language->code}.expertise")
                        ->label(__('team_page.fields.expertise_label')),
                    TextInput::make("sections.labels.{$language->code}.skills_title")
                        ->label(__('team_page.fields.skills_title')),
                    TextInput::make("sections.labels.{$language->code}.other_subtitle")
                        ->label(__('team_page.fields.other_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.other_title")
                        ->label(__('team_page.fields.other_title')),
                    TextInput::make("sections.labels.{$language->code}.cta_title")
                        ->label(__('team_page.fields.cta_title')),
                    TextInput::make("sections.labels.{$language->code}.cta_text")
                        ->label(__('team_page.fields.cta_text')),
                    TextInput::make("sections.labels.{$language->code}.cta_btn")
                        ->label(__('team_page.fields.cta_btn')),
                    TextInput::make("sections.labels.{$language->code}.cta_btn_contact")
                        ->label(__('team_page.fields.cta_btn_contact')),
                ]);
        }

        return [
            // Team Page sections
            Section::make(__('team_page.sections.hero'))
                ->schema([
                    Tabs::make('TeamHeroTranslations')
                        ->tabs($heroTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-page')
                ->collapsed(),

            Section::make(__('team_page.sections.leadership'))
                ->schema([
                    Tabs::make('TeamLeadershipTranslations')
                        ->tabs($leadershipTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-page')
                ->collapsed(),

            Section::make(__('team_page.sections.team'))
                ->schema([
                    Tabs::make('TeamSectionTranslations')
                        ->tabs($teamSectionTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-page')
                ->collapsed(),

            Section::make(__('team_page.sections.values'))
                ->schema([
                    Tabs::make('TeamValuesTranslations')
                        ->tabs($valuesTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-page')
                ->collapsed(),

            Section::make(__('team_page.sections.join'))
                ->schema([
                    TextInput::make('sections.join.email')
                        ->label('Email HR')
                        ->email(),
                    Tabs::make('TeamJoinTranslations')
                        ->tabs($joinTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-page')
                ->collapsed(),

            Section::make(__('team_page.sections.cta'))
                ->schema([
                    Tabs::make('TeamCTATranslations')
                        ->tabs($ctaTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-page')
                ->collapsed(),

            // Team Detail sections
            Section::make(__('team_page.sections.detail_labels'))
                ->description(__('team_page.sections.detail_labels_desc'))
                ->schema([
                    Tabs::make('TeamDetailLabelsTranslations')
                        ->tabs($detailLabelsTabs)
                        ->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'team-detail')
                ->collapsed(),
        ];
    }

    private static function servicesPageSections($languages): array
    {
        // Services Page Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                    TextInput::make("translations.{$language->code}.hero_btn")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Overview section tabs
        $overviewTabs = [];
        foreach ($languages as $language) {
            $overviewTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.overview.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.overview.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.overview.{$language->code}.details_btn")
                        ->label(__('module_pages.fields.details_btn')),
                ]);
        }

        // Process section tabs
        $processTabs = [];
        foreach ($languages as $language) {
            $processTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.process.{$language->code}.subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.process.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    TextInput::make("sections.process.{$language->code}.step_1_title")
                        ->label(__('module_pages.fields.step_title') . ' 1'),
                    Textarea::make("sections.process.{$language->code}.step_1_text")
                        ->label(__('module_pages.fields.step_text') . ' 1')->rows(2),
                    TextInput::make("sections.process.{$language->code}.step_2_title")
                        ->label(__('module_pages.fields.step_title') . ' 2'),
                    Textarea::make("sections.process.{$language->code}.step_2_text")
                        ->label(__('module_pages.fields.step_text') . ' 2')->rows(2),
                    TextInput::make("sections.process.{$language->code}.step_3_title")
                        ->label(__('module_pages.fields.step_title') . ' 3'),
                    Textarea::make("sections.process.{$language->code}.step_3_text")
                        ->label(__('module_pages.fields.step_text') . ' 3')->rows(2),
                    TextInput::make("sections.process.{$language->code}.step_4_title")
                        ->label(__('module_pages.fields.step_title') . ' 4'),
                    Textarea::make("sections.process.{$language->code}.step_4_text")
                        ->label(__('module_pages.fields.step_text') . ' 4')->rows(2),
                ]);
        }

        // CTA tabs
        $ctaTabs = [];
        foreach ($languages as $language) {
            $ctaTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.cta.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.cta.{$language->code}.text")
                        ->label(__('static_pages.fields.text'))->rows(2),
                    TextInput::make("sections.cta.{$language->code}.btn_text")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Service Detail labels tabs
        $detailTabs = [];
        foreach ($languages as $language) {
            $detailTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.labels.{$language->code}.about_subtitle")
                        ->label(__('module_pages.fields.about_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.offers_subtitle")
                        ->label(__('module_pages.fields.offers_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.offers_title")
                        ->label(__('module_pages.fields.offers_title')),
                    TextInput::make("sections.labels.{$language->code}.gallery_subtitle")
                        ->label(__('module_pages.fields.gallery_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.gallery_title")
                        ->label(__('module_pages.fields.gallery_title')),
                    TextInput::make("sections.labels.{$language->code}.other_subtitle")
                        ->label(__('module_pages.fields.other_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.other_title")
                        ->label(__('module_pages.fields.other_title')),
                ]);
        }

        return [
            Section::make(__('module_pages.sections.hero'))
                ->schema([
                    Tabs::make('ServicesHeroTranslations')->tabs($heroTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'services-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.overview'))
                ->schema([
                    Tabs::make('ServicesOverviewTranslations')->tabs($overviewTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'services-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.process'))
                ->schema([
                    Tabs::make('ServicesProcessTranslations')->tabs($processTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'services-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.cta'))
                ->schema([
                    Tabs::make('ServicesCTATranslations')->tabs($ctaTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'services-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.detail_labels'))
                ->description(__('module_pages.sections.detail_labels_desc'))
                ->schema([
                    Tabs::make('ServiceDetailLabels')->tabs($detailTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'service-detail')
                ->collapsed(),
        ];
    }

    private static function portfolioPageSections($languages): array
    {
        // Portfolio Page Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                ]);
        }

        // Stats tabs
        $statsTabs = [];
        foreach ($languages as $language) {
            $statsTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.stats.{$language->code}.events_label")->label(__('module_pages.fields.stat_events')),
                    TextInput::make("sections.stats.{$language->code}.clients_label")->label(__('module_pages.fields.stat_clients')),
                    TextInput::make("sections.stats.{$language->code}.years_label")->label(__('module_pages.fields.stat_years')),
                    TextInput::make("sections.stats.{$language->code}.satisfaction_label")->label(__('module_pages.fields.stat_satisfaction')),
                ]);
        }

        // Clients section tabs
        $clientsTabs = [];
        foreach ($languages as $language) {
            $clientsTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.clients.{$language->code}.subtitle")->label(__('static_pages.fields.subtitle')),
                    TextInput::make("sections.clients.{$language->code}.title")->label(__('static_pages.fields.title')),
                ]);
        }

        // CTA tabs
        $ctaTabs = [];
        foreach ($languages as $language) {
            $ctaTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.cta.{$language->code}.title")->label(__('static_pages.fields.title')),
                    Textarea::make("sections.cta.{$language->code}.text")->label(__('static_pages.fields.text'))->rows(2),
                    TextInput::make("sections.cta.{$language->code}.btn_text")->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Portfolio Detail labels tabs
        $detailTabs = [];
        foreach ($languages as $language) {
            $detailTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.labels.{$language->code}.view_gallery")->label(__('module_pages.fields.view_gallery')),
                    TextInput::make("sections.labels.{$language->code}.watch_video")->label(__('module_pages.fields.watch_video')),
                    TextInput::make("sections.labels.{$language->code}.scroll")->label(__('module_pages.fields.scroll')),
                    TextInput::make("sections.labels.{$language->code}.gallery_subtitle")->label(__('module_pages.fields.gallery_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.gallery_title")->label(__('module_pages.fields.gallery_title')),
                    TextInput::make("sections.labels.{$language->code}.video_subtitle")->label(__('module_pages.fields.video_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.video_title")->label(__('module_pages.fields.video_title')),
                    TextInput::make("sections.labels.{$language->code}.other_subtitle")->label(__('module_pages.fields.other_subtitle')),
                    TextInput::make("sections.labels.{$language->code}.other_title")->label(__('module_pages.fields.other_title')),
                    TextInput::make("sections.labels.{$language->code}.cta_title")->label(__('module_pages.fields.cta_title')),
                    TextInput::make("sections.labels.{$language->code}.cta_text")->label(__('module_pages.fields.cta_text')),
                    TextInput::make("sections.labels.{$language->code}.cta_btn")->label(__('module_pages.fields.cta_btn')),
                ]);
        }

        return [
            Section::make(__('module_pages.sections.hero'))
                ->schema([
                    Tabs::make('PortfolioHeroTranslations')->tabs($heroTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'portfolio-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.stats'))
                ->schema([
                    TextInput::make('sections.stats.events_number')->label(__('module_pages.fields.stat_events_number'))->numeric(),
                    TextInput::make('sections.stats.clients_number')->label(__('module_pages.fields.stat_clients_number'))->numeric(),
                    TextInput::make('sections.stats.years_number')->label(__('module_pages.fields.stat_years_number'))->numeric(),
                    TextInput::make('sections.stats.satisfaction_number')->label(__('module_pages.fields.stat_satisfaction_number')),
                    Tabs::make('PortfolioStatsTranslations')->tabs($statsTabs)->columnSpanFull(),
                ])
                ->columns(4)
                ->visible(fn ($get) => $get('template') === 'portfolio-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.clients'))
                ->schema([
                    Tabs::make('PortfolioClientsTranslations')->tabs($clientsTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'portfolio-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.cta'))
                ->schema([
                    Tabs::make('PortfolioCTATranslations')->tabs($ctaTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'portfolio-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.detail_labels'))
                ->description(__('module_pages.sections.detail_labels_desc'))
                ->schema([
                    Tabs::make('PortfolioDetailLabels')->tabs($detailTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'portfolio-detail')
                ->collapsed(),
        ];
    }

    private static function blogPageSections($languages): array
    {
        // Blog Page Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                ]);
        }

        // Labels tabs
        $labelsTabs = [];
        foreach ($languages as $language) {
            $labelsTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.labels.{$language->code}.all_posts")->label(__('module_pages.fields.all_posts')),
                    TextInput::make("sections.labels.{$language->code}.read_more")->label(__('module_pages.fields.read_more')),
                    TextInput::make("sections.labels.{$language->code}.search_placeholder")->label(__('module_pages.fields.search_placeholder')),
                    TextInput::make("sections.labels.{$language->code}.no_posts")->label(__('module_pages.fields.no_posts')),
                    TextInput::make("sections.labels.{$language->code}.categories")->label(__('module_pages.fields.categories')),
                    TextInput::make("sections.labels.{$language->code}.recent_posts")->label(__('module_pages.fields.recent_posts')),
                ]);
        }

        // Blog Detail labels tabs
        $detailTabs = [];
        foreach ($languages as $language) {
            $detailTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.labels.{$language->code}.share")->label(__('module_pages.fields.share')),
                    TextInput::make("sections.labels.{$language->code}.author")->label(__('module_pages.fields.author')),
                    TextInput::make("sections.labels.{$language->code}.published")->label(__('module_pages.fields.published')),
                    TextInput::make("sections.labels.{$language->code}.related_posts")->label(__('module_pages.fields.related_posts')),
                    TextInput::make("sections.labels.{$language->code}.back_to_blog")->label(__('module_pages.fields.back_to_blog')),
                ]);
        }

        return [
            Section::make(__('module_pages.sections.hero'))
                ->schema([
                    Tabs::make('BlogHeroTranslations')->tabs($heroTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'blog-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.page_labels'))
                ->schema([
                    Tabs::make('BlogLabelsTranslations')->tabs($labelsTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'blog-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.detail_labels'))
                ->description(__('module_pages.sections.detail_labels_desc'))
                ->schema([
                    Tabs::make('BlogDetailLabels')->tabs($detailTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'blog-detail')
                ->collapsed(),
        ];
    }

    private static function eventsPageSections($languages): array
    {
        // Events Page Hero tabs
        $heroTabs = [];
        foreach ($languages as $language) {
            $heroTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.hero_subtitle")
                        ->label(__('static_pages.fields.subtitle')),
                    TextInput::make("translations.{$language->code}.hero_title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("translations.{$language->code}.hero_text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                ]);
        }

        // CTA tabs
        $ctaTabs = [];
        foreach ($languages as $language) {
            $ctaTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.cta.{$language->code}.title")
                        ->label(__('static_pages.fields.title')),
                    Textarea::make("sections.cta.{$language->code}.text")
                        ->label(__('static_pages.fields.text'))
                        ->rows(2),
                    TextInput::make("sections.cta.{$language->code}.btn_text")
                        ->label(__('static_pages.fields.btn_text')),
                ]);
        }

        // Event Detail labels tabs
        $detailTabs = [];
        foreach ($languages as $language) {
            $detailTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("sections.labels.{$language->code}.about")
                        ->label(__('events.fields.about_label')),
                    TextInput::make("sections.labels.{$language->code}.gallery")
                        ->label(__('events.fields.gallery_label')),
                    TextInput::make("sections.labels.{$language->code}.videos")
                        ->label(__('events.fields.videos_label')),
                    TextInput::make("sections.labels.{$language->code}.upcoming_dates")
                        ->label(__('events.fields.upcoming_dates_label')),
                    TextInput::make("sections.labels.{$language->code}.regular_schedule")
                        ->label(__('events.fields.regular_schedule_label')),
                    TextInput::make("sections.labels.{$language->code}.cta_title")
                        ->label(__('events.fields.cta_title')),
                    TextInput::make("sections.labels.{$language->code}.cta_text")
                        ->label(__('events.fields.cta_text')),
                    TextInput::make("sections.labels.{$language->code}.cta_btn")
                        ->label(__('events.fields.cta_btn')),
                    TextInput::make("sections.labels.{$language->code}.other_events")
                        ->label(__('events.fields.other_events_label')),
                ]);
        }

        return [
            Section::make(__('module_pages.sections.hero'))
                ->schema([
                    Tabs::make('EventsHeroTranslations')->tabs($heroTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'events-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.cta'))
                ->schema([
                    Tabs::make('EventsCTATranslations')->tabs($ctaTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'events-page')
                ->collapsed(),

            Section::make(__('module_pages.sections.detail_labels'))
                ->description(__('module_pages.sections.detail_labels_desc'))
                ->schema([
                    Tabs::make('EventDetailLabels')->tabs($detailTabs)->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('template') === 'event-detail')
                ->collapsed(),
        ];
    }
}
