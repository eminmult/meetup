<?php

namespace App\Filament\Resources\StaticPages\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PagesTableColumns
{
    public static function columns(): array
    {
        return [
            TextColumn::make('title')
                ->label(__('pages.table.columns.title'))
                ->searchable(query: function ($query, string $search) {
                    return $query->where('translations', 'like', "%{$search}%");
                })
                ->sortable(query: function ($query, string $direction) {
                    return $query->orderBy('translations->az->title', $direction);
                }),

            TextColumn::make('slug')
                ->label(__('pages.table.columns.slug'))
                ->searchable()
                ->copyable()
                ->copyMessage('Скопировано'),

            TextColumn::make('template')
                ->label(__('pages.table.columns.template'))
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'default' => 'gray',
                    'home' => 'primary',
                    'contact' => 'info',
                    'about' => 'success',
                    'team-page' => 'warning',
                    'team-detail' => 'warning',
                    'full-width' => 'gray',
                    default => 'gray',
                }),

            IconColumn::make('is_published')
                ->label(__('pages.table.columns.is_published'))
                ->boolean()
                ->sortable(),

            IconColumn::make('show_in_menu')
                ->label(__('pages.table.columns.show_in_menu'))
                ->boolean()
                ->sortable(),

            TextColumn::make('updated_at')
                ->label(__('pages.table.columns.updated_at'))
                ->dateTime('d.m.Y H:i')
                ->sortable(),
        ];
    }
}
