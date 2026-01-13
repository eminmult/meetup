<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon')
                    ->label(__('events.fields.icon'))
                    ->alignCenter()
                    ->width(50),
                TextColumn::make('title')
                    ->label(__('events.fields.title'))
                    ->searchable(query: function ($query, $search) {
                        return $query->where('translations->ru->title', 'like', "%{$search}%")
                            ->orWhere('translations->en->title', 'like', "%{$search}%")
                            ->orWhere('translations->az->title', 'like', "%{$search}%");
                    })
                    ->sortable(),
                TextColumn::make('schedules_count')
                    ->label(__('events.fields.schedules_count'))
                    ->counts('schedules')
                    ->alignCenter(),
                TextColumn::make('dates_count')
                    ->label(__('events.fields.dates_count'))
                    ->counts('dates')
                    ->alignCenter(),
                TextColumn::make('sort_order')
                    ->label(__('events.fields.sort_order'))
                    ->sortable()
                    ->alignCenter(),
                IconColumn::make('is_published')
                    ->label(__('events.fields.is_published'))
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
                    ->label(__('events.fields.is_published')),
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.events.edit', ['record' => $record]))
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
