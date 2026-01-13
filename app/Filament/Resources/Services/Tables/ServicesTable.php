<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(ServicesTableColumns::get())
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->recordUrl(fn ($record) => route('filament.admin.resources.services.edit', ['record' => $record]))
            ->filters([])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->iconSize('lg')
                    ->tooltip(__('services.table.actions.edit'))
                    ->label(''),
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->iconSize('lg')
                    ->tooltip(__('services.table.actions.delete'))
                    ->label('')
                    ->requiresConfirmation()
                    ->modalHeading(__('services.table.actions.delete_confirm'))
                    ->modalDescription(__('services.table.actions.delete_description'))
                    ->action(function ($record) {
                        $record->delete();
                        Notification::make()
                            ->success()
                            ->title(__('services.table.actions.deleted_notification_title'))
                            ->body(__('services.table.actions.deleted_notification_body'))
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
