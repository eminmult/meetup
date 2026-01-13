<?php

namespace App\Filament\Resources\Awards\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AwardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('translations.ru.title')
                    ->label(__('awards.fields.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('translations.ru.organization')
                    ->label(__('awards.fields.organization'))
                    ->searchable(),
                TextColumn::make('year')
                    ->label(__('awards.fields.year'))
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label(__('awards.fields.is_published'))
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label(__('awards.fields.sort_order'))
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordUrl(fn ($record) => route('filament.admin.resources.awards.edit', ['record' => $record]))
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
            ]);
    }
}
