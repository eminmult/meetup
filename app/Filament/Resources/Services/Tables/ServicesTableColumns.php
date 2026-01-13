<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class ServicesTableColumns
{
    public static function get(): array
    {
        return [
            ImageColumn::make('preview')
                ->label(__('services.table.columns.image'))
                ->size(80)
                ->square()
                ->getStateUsing(function ($record) {
                    $firstMedia = $record->getMedia('service-gallery')->sortBy('order_column')->first();
                    if ($firstMedia) {
                        return $firstMedia->getFullUrl('thumb');
                    }
                    return null;
                }),
            TextColumn::make('title')
                ->label(__('services.table.columns.title'))
                ->searchable()
                ->description(function ($record) {
                    if ($record->excerpt) {
                        $text = mb_strlen($record->excerpt) > 60
                            ? mb_substr($record->excerpt, 0, 60) . '...'
                            : $record->excerpt;
                        return new \Illuminate\Support\HtmlString(
                            '<span style="color: #6b7280; font-size: 12px;">' . htmlspecialchars($text) . '</span>'
                        );
                    }
                    return null;
                }),
            TextColumn::make('price_display')
                ->label(__('services.table.columns.price'))
                ->getStateUsing(fn ($record) => $record->price_display),
            TextColumn::make('duration')
                ->label(__('services.table.columns.duration'))
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true),
            IconColumn::make('is_published')
                ->label(__('services.table.columns.is_published'))
                ->boolean(),
            IconColumn::make('is_featured')
                ->label(__('services.table.columns.is_featured'))
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
                ->label(__('services.table.columns.created_at'))
                ->dateTime('d.m.Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
