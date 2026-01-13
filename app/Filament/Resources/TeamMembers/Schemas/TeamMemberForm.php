<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Models\Language;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $contentTabs = [];
        foreach ($languages as $language) {
            $contentTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.name")
                        ->label(__('team.fields.name'))
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, ?string $state, $get) use ($language) {
                            if ($state && !$get("translations.{$language->code}.slug")) {
                                $slug = Str::slug($state);
                                $set("translations.{$language->code}.slug", $slug);
                            }
                        })
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.position")
                        ->label(__('team.fields.position'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make("translations.{$language->code}.tagline")
                        ->label(__('team.fields.tagline'))
                        ->maxLength(255)
                        ->placeholder(__('team.fields.tagline_placeholder'))
                        ->columnSpanFull(),
                    Textarea::make("translations.{$language->code}.bio")
                        ->label(__('team.fields.bio'))
                        ->rows(4)
                        ->columnSpanFull(),
                ]);
        }

        return $schema
            ->columns(1)
            ->components([
                Section::make(__('team.sections.photo'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->label(__('team.fields.avatar'))
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

                Section::make(__('team.sections.contacts'))
                    ->schema([
                        TextInput::make('email')
                            ->label(__('team.fields.email'))
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label(__('team.fields.phone'))
                            ->tel()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make(__('team.sections.social'))
                    ->schema([
                        Repeater::make('social_links')
                            ->label(__('team.fields.social_links'))
                            ->schema([
                                Select::make('platform')
                                    ->label(__('team.fields.platform'))
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'instagram' => 'Instagram',
                                        'twitter' => 'X (Twitter)',
                                        'linkedin' => 'LinkedIn',
                                        'telegram' => 'Telegram',
                                        'youtube' => 'YouTube',
                                        'tiktok' => 'TikTok',
                                        'website' => __('team.fields.website'),
                                    ])
                                    ->required(),
                                TextInput::make('url')
                                    ->label(__('team.fields.url'))
                                    ->url()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['platform'] ?? null)
                            ->addActionLabel(__('team.fields.add_social'))
                            ->columnSpanFull(),
                    ]),

                Section::make(__('team.sections.stats'))
                    ->description(__('team.sections.stats_desc'))
                    ->schema([
                        Repeater::make('stats')
                            ->label(__('team.fields.stats'))
                            ->schema([
                                TextInput::make('number')
                                    ->label(__('team.fields.stat_number'))
                                    ->placeholder('15+')
                                    ->required(),
                                TextInput::make('label')
                                    ->label(__('team.fields.stat_label'))
                                    ->placeholder(__('team.fields.stat_label_placeholder'))
                                    ->required(),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->maxItems(4)
                            ->itemLabel(fn (array $state): ?string => ($state['number'] ?? '') . ' ' . ($state['label'] ?? ''))
                            ->addActionLabel(__('team.fields.add_stat'))
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),

                Section::make(__('team.sections.skills'))
                    ->description(__('team.sections.skills_desc'))
                    ->schema([
                        Repeater::make('skills')
                            ->label(__('team.fields.skills'))
                            ->schema([
                                Select::make('icon')
                                    ->label(__('team.fields.skill_icon'))
                                    ->options([
                                        'layers' => __('team.icons.layers'),
                                        'users' => __('team.icons.users'),
                                        'globe' => __('team.icons.globe'),
                                        'star' => __('team.icons.star'),
                                        'target' => __('team.icons.target'),
                                        'award' => __('team.icons.award'),
                                        'briefcase' => __('team.icons.briefcase'),
                                        'heart' => __('team.icons.heart'),
                                        'zap' => __('team.icons.zap'),
                                        'compass' => __('team.icons.compass'),
                                    ])
                                    ->required(),
                                TextInput::make('title')
                                    ->label(__('team.fields.skill_title'))
                                    ->required(),
                                Textarea::make('description')
                                    ->label(__('team.fields.skill_description'))
                                    ->rows(2),
                            ])
                            ->columns(1)
                            ->reorderable()
                            ->collapsible()
                            ->maxItems(6)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->addActionLabel(__('team.fields.add_skill'))
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),

                Section::make(__('team.sections.settings'))
                    ->schema([
                        TextInput::make('slug')
                            ->label(__('common.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TextInput::make('sort_order')
                            ->label(__('team.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_leader')
                            ->label(__('team.fields.is_leader'))
                            ->helperText(__('team.fields.is_leader_help'))
                            ->default(false),
                        Toggle::make('is_published')
                            ->label(__('team.fields.is_published'))
                            ->default(true),
                    ])
                    ->columns(4),
            ]);
    }
}
