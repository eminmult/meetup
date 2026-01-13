<?php

namespace App\Filament\Resources\Testimonials\Tables;

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

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->conversion('thumb')
                    ->circular()
                    ->label(__('testimonials.fields.avatar'))
                    ->width(50)
                    ->height(50),
                TextColumn::make('author_name')
                    ->label(__('testimonials.fields.author_name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('author_position')
                    ->label(__('testimonials.fields.author_position'))
                    ->searchable(),
                TextColumn::make('text')
                    ->label(__('testimonials.fields.text'))
                    ->limit(50)
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label(__('testimonials.fields.sort_order'))
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label(__('testimonials.fields.is_published'))
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
                    ->label(__('testimonials.fields.is_published')),
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.testimonials.edit', ['record' => $record]))
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
