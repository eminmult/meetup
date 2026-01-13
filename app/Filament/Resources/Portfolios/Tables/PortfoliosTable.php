<?php

namespace App\Filament\Resources\Portfolios\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PortfoliosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('gallery')
                    ->collection('portfolio-gallery')
                    ->conversion('thumb')
                    ->label(__('portfolio.fields.image'))
                    ->width(80)
                    ->height(60)
                    ->square(),
                TextColumn::make('title')
                    ->label(__('portfolio.fields.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label(__('portfolio.fields.category'))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('project_date')
                    ->label(__('portfolio.fields.project_date'))
                    ->date('d.m.Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label(__('portfolio.fields.sort_order'))
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label(__('portfolio.fields.is_featured'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_published')
                    ->label(__('portfolio.fields.is_published'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('common.fields.updated_at'))
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('portfolio_category_id')
                    ->label(__('portfolio.fields.category'))
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_published')
                    ->label(__('portfolio.fields.is_published')),
                TernaryFilter::make('is_featured')
                    ->label(__('portfolio.fields.is_featured')),
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.portfolios.edit', ['record' => $record]))
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
