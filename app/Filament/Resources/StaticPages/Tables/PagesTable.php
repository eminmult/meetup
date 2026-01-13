<?php

namespace App\Filament\Resources\StaticPages\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(PagesTableColumns::columns())
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->recordUrl(fn ($record) => route('filament.admin.resources.pages.edit', ['record' => $record]))
            ->filters([])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->iconSize('lg')
                    ->tooltip(__('pages.table.actions.edit'))
                    ->label(''),
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->iconSize('lg')
                    ->tooltip(__('pages.table.actions.delete'))
                    ->label('')
                    ->requiresConfirmation()
                    ->modalHeading(__('pages.table.actions.delete_confirm'))
                    ->modalDescription(__('pages.table.actions.delete_description'))
                    ->action(function ($record) {
                        $record->delete();
                        Notification::make()
                            ->success()
                            ->title(__('pages.table.actions.deleted_notification_title'))
                            ->send();
                    })
                    ->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
