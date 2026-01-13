<?php

namespace App\Filament\Resources\Partners\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PartnersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('logo')
                    ->collection('logo')
                    ->conversion('thumb')
                    ->label(__('partners.fields.logo'))
                    ->width(120)
                    ->height(60),
                TextColumn::make('name')
                    ->label(__('partners.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('website_url')
                    ->label(__('partners.fields.website_url'))
                    ->limit(30)
                    ->url(fn ($record) => $record->website_url, true)
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label(__('partners.fields.sort_order'))
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label(__('partners.fields.is_published'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('common.fields.updated_at'))
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label(__('partners.fields.is_published')),
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.partners.edit', ['record' => $record]))
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->iconSize('lg')
                    ->tooltip(__('common.actions.edit'))
                    ->label(''),
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->iconSize('lg')
                    ->tooltip(__('common.actions.delete'))
                    ->label('')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->delete();
                        Notification::make()
                            ->success()
                            ->title(__('common.notifications.deleted'))
                            ->send();
                    })
                    ->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }
}
