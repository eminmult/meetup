<?php

namespace App\Filament\Resources\TeamMembers\Tables;

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

class TeamMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->conversion('thumb')
                    ->circular()
                    ->label(__('team.fields.avatar'))
                    ->width(50)
                    ->height(50),
                TextColumn::make('name')
                    ->label(__('team.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('position')
                    ->label(__('team.fields.position'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('team.fields.email'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label(__('team.fields.sort_order'))
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label(__('team.fields.is_published'))
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
                    ->label(__('team.fields.is_published')),
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.team.edit', ['record' => $record]))
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
