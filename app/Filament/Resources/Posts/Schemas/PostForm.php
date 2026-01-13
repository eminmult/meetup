<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Forms\Components\TinyMCEEditor;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostWidget;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Closure;

class PostForm
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
                $videoId = PostWidget::extractYoutubeId($content);
                $preview .= '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">';
                $preview .= '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ';
                $preview .= 'src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" ';
                $preview .= 'frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                $preview .= '</div>';
                break;

            case 'okru':
                $videoId = PostWidget::extractOkruId($content);
                $preview .= '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">';
                $preview .= '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ';
                $preview .= 'src="https://ok.ru/videoembed/' . htmlspecialchars($videoId) . '" ';
                $preview .= 'frameborder="0" allow="autoplay" allowfullscreen></iframe>';
                $preview .= '</div>';
                break;

            case 'instagram':
                $postId = PostWidget::extractInstagramId($content);
                $preview .= '<div style="max-width: 540px; margin: 0 auto;">';
                $preview .= '<p style="margin-bottom: 0.5rem; color: #6b7280; font-size: 14px;">Instagram пост ID: <strong>' . htmlspecialchars($postId) . '</strong></p>';
                $preview .= '<iframe src="https://www.instagram.com/p/' . htmlspecialchars($postId) . '/embed/" width="540" height="710" frameborder="0" scrolling="no" allowtransparency="true" style="border: 1px solid #e5e7eb; border-radius: 8px;"></iframe>';
                $preview .= '</div>';
                break;

            case 'telegram':
            case 'fbvideo':
            case 'x':
            case 'html':
                // For embed codes and HTML, show the actual content
                $preview .= '<div style="max-height: 500px; overflow: auto;">';
                $preview .= $content;
                $preview .= '</div>';
                break;

            default:
                $preview .= '<p style="color: #6b7280;">' . __('posts.fields.widget_preview_not_supported') . '</p>';
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
                        ->label(__('common.fields.title'))
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, ?string $state, $get) use ($language) {
                            // Generate slug from title
                            if ($state && !$get("translations.{$language->code}.slug")) {
                                $cleanState = preg_replace('/[?!.,;:\'\"«»""„\(\)\[\]{}]/', '', $state ?? '');
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
                        ->label(__('common.fields.content'))
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('post-images')
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
                            'codeBlock',
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
                Section::make(__('common.sections.content_by_languages'))
                    ->schema([
                        Tabs::make('ContentTranslations')
                            ->tabs($contentTabs)
                            ->columnSpanFull(),
                    ]),


                Section::make(__('posts.sections.gallery'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('post-gallery')
                            ->label(__('posts.fields.gallery'))
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
                            ->helperText(__('posts.fields.gallery_helper'))
                            ->columnSpanFull()
                            ->extraAttributes([
                                'x-init' => "setTimeout(() => { const container = \$el.querySelector('[x-sortable-container]'); if (container) { container.style.gridTemplateColumns = 'repeat(5, minmax(0, 1fr))'; } }, 100)"
                            ])
                            ->live(),
                    ])
                    ->columns(1),

                Section::make(__('posts.sections.category'))
                    ->schema([
                        CheckboxList::make('categories')
                            ->label(__('posts.fields.categories'))
                            ->relationship('categories', 'name')
                            ->required()
                            ->columns(3)
                            ->gridDirection('row')
                            ->bulkToggleable()
                            ->helperText(__('posts.fields.categories_helper'))
                            ->columnSpanFull(),
                    ]),

                Section::make(__('posts.sections.widgets'))
                    ->schema([
                        Repeater::make('widgets')
                            ->relationship('widgets')
                            ->mutateRelationshipDataBeforeCreateUsing(function (array $data): ?array {
                                // Skip empty widgets
                                if (empty($data['content'])) {
                                    return null;
                                }

                                // Extract YouTube ID from URL
                                if ($data['type'] === 'youtube' && !empty($data['content'])) {
                                    $data['content'] = PostWidget::extractYoutubeId($data['content']);
                                }
                                // Extract OK.ru ID from URL
                                if ($data['type'] === 'okru' && !empty($data['content'])) {
                                    $data['content'] = PostWidget::extractOkruId($data['content']);
                                }
                                // Extract Instagram ID from URL
                                if ($data['type'] === 'instagram' && !empty($data['content'])) {
                                    $data['content'] = PostWidget::extractInstagramId($data['content']);
                                }
                                return $data;
                            })
                            ->mutateRelationshipDataBeforeSaveUsing(function (array $data): ?array {
                                // Skip empty widgets
                                if (empty($data['content'])) {
                                    return null;
                                }

                                // Extract YouTube ID from URL
                                if ($data['type'] === 'youtube' && !empty($data['content'])) {
                                    $data['content'] = PostWidget::extractYoutubeId($data['content']);
                                }
                                // Extract OK.ru ID from URL
                                if ($data['type'] === 'okru' && !empty($data['content'])) {
                                    $data['content'] = PostWidget::extractOkruId($data['content']);
                                }
                                // Extract Instagram ID from URL
                                if ($data['type'] === 'instagram' && !empty($data['content'])) {
                                    $data['content'] = PostWidget::extractInstagramId($data['content']);
                                }
                                return $data;
                            })
                            ->schema([
                                Textarea::make('content')
                                    ->label(__('posts.fields.widget_content'))
                                    ->placeholder(__('posts.fields.widget_content_placeholder'))
                                    ->helperText(fn ($get) => match($get('type')) {
                                        'youtube' => __('posts.widget_helpers.youtube'),
                                        'okru' => __('posts.widget_helpers.okru'),
                                        'instagram' => __('posts.widget_helpers.instagram'),
                                        'telegram' => __('posts.widget_helpers.telegram'),
                                        'x' => __('posts.widget_helpers.x'),
                                        'fbvideo' => __('posts.widget_helpers.fbvideo'),
                                        default => __('posts.widget_helpers.default')
                                    })
                                    ->rows(3)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        // Auto-detect widget type
                                        if ($state) {
                                            $detectedType = self::detectWidgetType($state);
                                            if ($detectedType) {
                                                $set('type', $detectedType);
                                            }
                                        }
                                    })
                                    ->columnSpanFull(),
                                Select::make('type')
                                    ->label(__('posts.fields.widget_type'))
                                    ->options([
                                        'youtube' => __('posts.widget_types.youtube'),
                                        'telegram' => __('posts.widget_types.telegram'),
                                        'instagram' => __('posts.widget_types.instagram'),
                                        'fbvideo' => __('posts.widget_types.fbvideo'),
                                        'okru' => __('posts.widget_types.okru'),
                                        'x' => __('posts.widget_types.x'),
                                        'html' => __('posts.widget_types.html'),
                                    ])
                                    ->live()
                                    ->helperText(__('posts.fields.widget_type_helper')),
                                Placeholder::make('preview')
                                    ->label(__('posts.fields.widget_preview'))
                                    ->content(function ($get) {
                                        $type = $get('type');
                                        $content = $get('content');

                                        if (!$type || !$content) {
                                            return new HtmlString('<div style="padding: 1rem; background: #f3f4f6; border-radius: 0.5rem; text-align: center; color: #6b7280;">' . __('posts.fields.widget_preview_empty') . '</div>');
                                        }

                                        return new HtmlString(self::generatePreview($type, $content));
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->orderColumn('order')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => match($state['type'] ?? null) {
                                'youtube' => __('posts.widget_labels.youtube'),
                                'telegram' => __('posts.widget_labels.telegram'),
                                'instagram' => __('posts.widget_labels.instagram'),
                                'fbvideo' => __('posts.widget_labels.fbvideo'),
                                'okru' => __('posts.widget_labels.okru'),
                                'x' => __('posts.widget_labels.x'),
                                'html' => __('posts.widget_labels.html'),
                                default => __('posts.widget_labels.default'),
                            })
                            ->addActionLabel(__('posts.fields.add_widget'))
                            ->columnSpanFull(),
                    ]),

                Section::make(__('posts.sections.display_settings'))
                    ->schema([
                        Toggle::make('is_published')
                            ->label(__('posts.fields.is_published'))
                            ->default(true)
                            ->helperText(__('posts.fields.is_published_helper'))
                            ->columnSpanFull(),
                        DateTimePicker::make('published_at')
                            ->label(__('posts.fields.published_at'))
                            ->default(now())
                            ->seconds(false)
                            ->native(false)
                            ->locale('ru')
                            ->displayFormat('d M Y, H:i')
                            ->helperText(__('posts.fields.published_at_helper'))
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
