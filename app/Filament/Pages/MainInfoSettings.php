<?php

namespace App\Filament\Pages;

use App\Models\Language;
use App\Models\MainInfo;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class MainInfoSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    public static function getNavigationLabel(): string
    {
        return __('main-info.navigation_label');
    }

    public function getTitle(): string
    {
        return __('main-info.title');
    }

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.main-info-settings';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === User::ROLE_ADMIN;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $mainInfo = MainInfo::getOrCreate();
        $this->form->fill($mainInfo->toArray());
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('main-info.actions.save'))
                ->action('save'),
        ];
    }

    public function form(Schema $form): Schema
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order')->get();

        $translationTabs = [];
        foreach ($languages as $language) {
            $translationTabs[] = Tab::make("{$language->flag} {$language->native_name}")
                ->schema([
                    TextInput::make("translations.{$language->code}.site_name")
                        ->label(__('main-info.fields.site_name'))
                        ->maxLength(255),

                    Textarea::make("translations.{$language->code}.site_title")
                        ->label(__('main-info.fields.site_title'))
                        ->rows(2)
                        ->maxLength(500),

                    Textarea::make("translations.{$language->code}.site_description")
                        ->label(__('main-info.fields.site_description'))
                        ->rows(3)
                        ->maxLength(1000),

                    Textarea::make("translations.{$language->code}.address")
                        ->label(__('main-info.fields.address'))
                        ->rows(2)
                        ->maxLength(500),

                    Textarea::make("translations.{$language->code}.meta_title")
                        ->label(__('main-info.fields.meta_title'))
                        ->rows(2)
                        ->maxLength(255),

                    Textarea::make("translations.{$language->code}.meta_description")
                        ->label(__('main-info.fields.meta_description'))
                        ->rows(3)
                        ->maxLength(500),

                    Textarea::make("translations.{$language->code}.meta_keywords")
                        ->label(__('main-info.fields.meta_keywords'))
                        ->rows(2)
                        ->maxLength(500),
                ]);
        }

        return $form
            ->components([
                Section::make(__('main-info.sections.main'))
                    ->schema([
                        TextInput::make('site_url')
                            ->label(__('main-info.fields.site_url'))
                            ->url()
                            ->maxLength(255),
                    ]),

                Section::make(__('main-info.sections.content_by_languages'))
                    ->schema([
                        Tabs::make('Translations')
                            ->tabs($translationTabs)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('main-info.sections.contact'))
                    ->schema([
                        Repeater::make('emails')
                            ->label(__('main-info.fields.emails'))
                            ->simple(
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                            )
                            ->defaultItems(1)
                            ->addActionLabel(__('main-info.actions.add_email')),

                        Repeater::make('phones')
                            ->label(__('main-info.fields.phones'))
                            ->simple(
                                TextInput::make('phone')
                                    ->tel()
                                    ->required()
                            )
                            ->defaultItems(1)
                            ->addActionLabel(__('main-info.actions.add_phone')),

                        TextInput::make('fax')
                            ->label(__('main-info.fields.fax'))
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('location')
                            ->label(__('main-info.fields.location'))
                            ->url()
                            ->maxLength(500)
                            ->placeholder(__('main-info.fields.location_placeholder')),
                    ])->columns(2),

                Section::make(__('main-info.sections.advertising'))
                    ->schema([
                        Repeater::make('reklam_emails')
                            ->label(__('main-info.fields.reklam_emails'))
                            ->simple(
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                            )
                            ->defaultItems(0)
                            ->addActionLabel(__('main-info.actions.add_email')),

                        Repeater::make('reklam_phones')
                            ->label(__('main-info.fields.reklam_phones'))
                            ->simple(
                                TextInput::make('phone')
                                    ->tel()
                                    ->required()
                            )
                            ->defaultItems(0)
                            ->addActionLabel(__('main-info.actions.add_phone')),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $mainInfo = MainInfo::getOrCreate();
        $mainInfo->update($data);

        // Очищаем все кеши
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');

        Notification::make()
            ->success()
            ->title(__('main-info.notifications.saved_title'))
            ->body(__('main-info.notifications.saved_body'))
            ->send();
    }
}
