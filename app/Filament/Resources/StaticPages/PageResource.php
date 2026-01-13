<?php

namespace App\Filament\Resources\StaticPages;

use App\Filament\Resources\StaticPages\Pages\CreatePage;
use App\Filament\Resources\StaticPages\Pages\EditPage;
use App\Filament\Resources\StaticPages\Pages\ListPages;
use App\Filament\Resources\StaticPages\Schemas\PageForm;
use App\Filament\Resources\StaticPages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $slug = 'pages';

    protected static ?int $navigationSort = 50;

    public static function getModelLabel(): string
    {
        return __('pages.resource.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('pages.resource.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('pages.resource.navigation_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('pages.resource.navigation_group');
    }

    public static function form(Schema $schema): Schema
    {
        return PageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
