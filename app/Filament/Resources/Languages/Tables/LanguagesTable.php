<?php

namespace App\Filament\Resources\Languages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LanguagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('flag')
                    ->label(__('languages.table.columns.flag'))
                    ->alignCenter(),
                TextColumn::make('code')
                    ->label(__('languages.table.columns.code'))
                    ->badge()
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('languages.table.columns.name'))
                    ->searchable(),
                TextColumn::make('native_name')
                    ->label(__('languages.table.columns.native_name'))
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label(__('languages.table.columns.is_active'))
                    ->boolean(),
                IconColumn::make('is_default')
                    ->label(__('languages.table.columns.is_default'))
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label(__('languages.table.columns.sort_order'))
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
