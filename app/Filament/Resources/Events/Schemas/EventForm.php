<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\EventWidget;
use App\Models\Language;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class EventForm
{
    private static function detectWidgetType(string $content): ?string
    {
        $content = trim($content);

        // YouTube detection
        if (preg_match('/(youtube\.com|youtu\.be)/i', $content)) {
            return 'youtube';
        }

        // OK.ru detection
        if (preg_match('/ok\.ru/i', $content)) {
            return 'okru';
        }

        // Telegram detection
        if (preg_match('/(t\.me|telegram\.org)/i', $content) ||
            preg_match('/<script[^>]*telegram[^>]*>/i', $content)) {
            return 'telegram';
        }

        // Instagram detection
        if (preg_match('/instagram\.com/i', $content) ||
            preg_match('/<blockquote[^>]*instagram-media/i', $content)) {
            return 'instagram';
        }

        // Facebook Video detection
        if (preg_match('/facebook\.com.*\/videos/i', $content) ||
            preg_match('/<iframe[^>]*facebook\.com.*video/i', $content)) {
            return 'fbvideo';
        }

        // X.com / Twitter detection
        if (preg_match('/(x\.com|twitter\.com)/i', $content) ||
            preg_match('/<blockquote[^>]*twitter-tweet/i', $content)) {
            return 'x';
        }

        // If contains HTML tags, default to html
        if (preg_match('/<[^>]+>/', $content)) {
            return 'html';
        }

        return null;
    }

    private static function generatePreview(string $type, string $content): string
    {
        $preview = '<div style="padding: 1rem; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem;">';

        switch ($type) {
            case 'youtube':
                $videoId = EventWidget::extractYoutubeId($content);
                $preview .= '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">';
                $preview .= '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ';
                $preview .= 'src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" ';
                $preview .= 'frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                $preview .= '</div>';
                break;

            case 'okru':
                $videoId = EventWidget::extractOkruId($content);
                $preview .= '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">';
                $preview .= '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ';
                $preview .= 'src="https://ok.ru/videoembed/' . htmlspecialchars($videoId) . '" ';
                $preview .= 'frameborder="0" allow="autoplay" allowfullscreen></iframe>';
                $preview .= '</div>';
                break;

            case 'instagram':
                $postId = EventWidget::extractInstagramId($content);
                $preview .= '<div style="max-width: 540px; margin: 0 auto;">';
                $preview .= '<p style="margin-bottom: 0.5rem; color: #6b7280; font-size: 14px;">Instagram пост ID: <strong>' . htmlspecialchars($postId) . '</strong></p>';
                $preview .= '<iframe src="https://www.instagram.com/p/' . htmlspecialchars($postId) . '/embed/" width="540" height="710" frameborder="0" scrolling="no" allowtransparency="true" style="border: 1px solid #e5e7eb; border-radius: 8px;"></iframe>';
                $preview .= '</div>';
                break;

            case 'telegram':
            case 'fbvideo':
            case 'x':
            case 'html':
                $preview .= '<div style="max-height: 500px; overflow: auto;">';
                $preview .= $content;
                $preview .= '</div>';
                break;

            default:
                $preview .= '<p style="color: #6b7280;">' . __('events.widget_preview_not_supported') . '</p>';
        }

        $preview .= '</div>';

        return $preview;
    }

    public static function configure(Schema $schema): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $contentTabs = [];
        foreach ($languages as $language) {
            $contentTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.title")
                        ->label(__('events.fields.title'))
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, $set, $get) use ($language) {
                            $currentSlug = $get("translations.{$language->code}.slug");
                            if (empty($currentSlug) && $state) {
                                $set("translations.{$language->code}.slug", \Illuminate\Support\Str::slug($state));
                            }
                        })
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.slug")
                        ->label(__('common.fields.slug'))
                        ->helperText(__('common.fields.slug_helper'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Textarea::make("translations.{$language->code}.description")
                        ->label(__('events.fields.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                ]);
        }

        return $schema
            ->columns(1)
            ->components([
                Section::make(__('events.sections.main'))
                    ->schema([
                        TextInput::make('icon')
                            ->label(__('events.fields.icon'))
                            ->placeholder('🎭')
                            ->helperText(__('events.fields.icon_hint'))
                            ->maxLength(10),
                    ]),

                Section::make(__('common.sections.content_by_languages'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('events.sections.gallery'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('event-gallery')
                            ->label(__('events.fields.gallery'))
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->maxFiles(50)
                            ->image()
                            ->imageEditor()
                            ->maxSize(20480)
                            ->imagePreviewHeight('120')
                            ->panelLayout('grid')
                            ->conversion('thumb')
                            ->helperText(__('events.fields.gallery_helper'))
                            ->columnSpanFull()
                            ->live(),
                    ])
                    ->columns(1)
                    ->collapsed(),

                Section::make(__('events.sections.widgets'))
                    ->description(__('events.sections.widgets_description'))
                    ->schema([
                        Repeater::make('widgets')
                            ->relationship('widgets')
                            ->mutateRelationshipDataBeforeCreateUsing(function (array $data): ?array {
                                if (empty($data['content'])) {
                                    return null;
                                }

                                if ($data['type'] === 'youtube' && !empty($data['content'])) {
                                    $data['content'] = EventWidget::extractYoutubeId($data['content']);
                                }
                                if ($data['type'] === 'okru' && !empty($data['content'])) {
                                    $data['content'] = EventWidget::extractOkruId($data['content']);
                                }
                                if ($data['type'] === 'instagram' && !empty($data['content'])) {
                                    $data['content'] = EventWidget::extractInstagramId($data['content']);
                                }
                                return $data;
                            })
                            ->mutateRelationshipDataBeforeSaveUsing(function (array $data): ?array {
                                if (empty($data['content'])) {
                                    return null;
                                }

                                if ($data['type'] === 'youtube' && !empty($data['content'])) {
                                    $data['content'] = EventWidget::extractYoutubeId($data['content']);
                                }
                                if ($data['type'] === 'okru' && !empty($data['content'])) {
                                    $data['content'] = EventWidget::extractOkruId($data['content']);
                                }
                                if ($data['type'] === 'instagram' && !empty($data['content'])) {
                                    $data['content'] = EventWidget::extractInstagramId($data['content']);
                                }
                                return $data;
                            })
                            ->schema([
                                Textarea::make('content')
                                    ->label(__('events.fields.widget_content'))
                                    ->placeholder(__('events.fields.widget_content_placeholder'))
                                    ->helperText(fn ($get) => match($get('type')) {
                                        'youtube' => __('events.widget_helpers.youtube'),
                                        'okru' => __('events.widget_helpers.okru'),
                                        'instagram' => __('events.widget_helpers.instagram'),
                                        'telegram' => __('events.widget_helpers.telegram'),
                                        'x' => __('events.widget_helpers.x'),
                                        'fbvideo' => __('events.widget_helpers.fbvideo'),
                                        default => __('events.widget_helpers.default')
                                    })
                                    ->rows(3)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        if ($state) {
                                            $detectedType = self::detectWidgetType($state);
                                            if ($detectedType) {
                                                $set('type', $detectedType);
                                            }
                                        }
                                    })
                                    ->columnSpanFull(),
                                Select::make('type')
                                    ->label(__('events.fields.widget_type'))
                                    ->options([
                                        'youtube' => __('events.widget_types.youtube'),
                                        'telegram' => __('events.widget_types.telegram'),
                                        'instagram' => __('events.widget_types.instagram'),
                                        'fbvideo' => __('events.widget_types.fbvideo'),
                                        'okru' => __('events.widget_types.okru'),
                                        'x' => __('events.widget_types.x'),
                                        'html' => __('events.widget_types.html'),
                                    ])
                                    ->live()
                                    ->helperText(__('events.fields.widget_type_helper')),
                                Placeholder::make('preview')
                                    ->label(__('events.fields.widget_preview'))
                                    ->content(function ($get) {
                                        $type = $get('type');
                                        $content = $get('content');

                                        if (!$type || !$content) {
                                            return new HtmlString('<div style="padding: 1rem; background: #f3f4f6; border-radius: 0.5rem; text-align: center; color: #6b7280;">' . __('events.fields.widget_preview_empty') . '</div>');
                                        }

                                        return new HtmlString(self::generatePreview($type, $content));
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->orderColumn('order')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => match($state['type'] ?? null) {
                                'youtube' => '📹 YouTube',
                                'telegram' => '📨 Telegram',
                                'instagram' => '📷 Instagram',
                                'fbvideo' => '📘 Facebook Video',
                                'okru' => '🔵 OK.ru',
                                'x' => '𝕏 X/Twitter',
                                'html' => '🌐 HTML',
                                default => '➕ ' . __('events.widget_labels.default'),
                            })
                            ->addActionLabel(__('events.actions.add_widget'))
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),

                Section::make(__('events.sections.regular_schedule'))
                    ->description(__('events.sections.regular_schedule_description'))
                    ->schema([
                        Repeater::make('schedules')
                            ->relationship()
                            ->label('')
                            ->schema([
                                Select::make('day_of_week')
                                    ->label(__('events.fields.day_of_week'))
                                    ->options([
                                        1 => __('events.days.monday'),
                                        2 => __('events.days.tuesday'),
                                        3 => __('events.days.wednesday'),
                                        4 => __('events.days.thursday'),
                                        5 => __('events.days.friday'),
                                        6 => __('events.days.saturday'),
                                        7 => __('events.days.sunday'),
                                    ])
                                    ->required(),
                                TimePicker::make('start_time')
                                    ->label(__('events.fields.start_time'))
                                    ->seconds(false)
                                    ->required(),
                                TimePicker::make('end_time')
                                    ->label(__('events.fields.end_time'))
                                    ->seconds(false),
                            ])
                            ->columns(3)
                            ->addActionLabel(__('events.actions.add_schedule'))
                            ->reorderable(false)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('events.sections.specific_dates'))
                    ->description(__('events.sections.specific_dates_description'))
                    ->schema([
                        Repeater::make('dates')
                            ->relationship()
                            ->label('')
                            ->schema([
                                DatePicker::make('date')
                                    ->label(__('events.fields.date'))
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),
                                TimePicker::make('start_time')
                                    ->label(__('events.fields.start_time'))
                                    ->seconds(false)
                                    ->required(),
                                TimePicker::make('end_time')
                                    ->label(__('events.fields.end_time'))
                                    ->seconds(false),
                                TextInput::make('note')
                                    ->label(__('events.fields.note'))
                                    ->placeholder(__('events.fields.note_placeholder'))
                                    ->maxLength(255),
                            ])
                            ->columns(4)
                            ->addActionLabel(__('events.actions.add_date'))
                            ->reorderable(false)
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),

                Section::make(__('events.sections.settings'))
                    ->schema([
                        TextInput::make('sort_order')
                            ->label(__('events.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_published')
                            ->label(__('events.fields.is_published'))
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
