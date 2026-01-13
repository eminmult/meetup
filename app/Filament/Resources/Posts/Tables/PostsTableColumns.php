<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class PostsTableColumns
{
    public static function get(): array
    {
        return [
            TextColumn::make('title')
                ->label(__('posts.table.columns.title'))
                ->searchable()
                ->formatStateUsing(function ($state, $record) {
                    $html = '';

                    // Показываем кто редактирует пост
                    $lock = $record->lock;
                    if ($lock && $lock->isActive()) {
                        $html .= '<span style="display: inline-block; background: #f59e0b; color: white; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 500; margin-right: 6px;">✏️ '
                            . htmlspecialchars($lock->user->name)
                            . '</span>';
                    }

                    $html .= htmlspecialchars($state);

                    return new \Illuminate\Support\HtmlString($html);
                })
                ->description(function ($record) {
                    // Дата публикации
                    if ($record->published_at) {
                        $publishedDate = \Carbon\Carbon::parse($record->published_at);
                        $isToday = $publishedDate->isToday();

                        if ($isToday) {
                            return new \Illuminate\Support\HtmlString(
                                '<span style="font-weight: 600; color: #059669; font-size: 13px;">'
                                . $publishedDate->format('H:i')
                                . '</span>'
                            );
                        } else {
                            return new \Illuminate\Support\HtmlString(
                                '<span style="color: #6b7280; font-size: 13px;">'
                                . $publishedDate->format('d.m.Y H:i')
                                . '</span>'
                            );
                        }
                    }

                    return null;
                }),
            ImageColumn::make('preview')
                ->label(__('posts.table.columns.featured_image'))
                ->size(80)
                ->square()
                ->getStateUsing(function ($record) {
                    // Берем первое фото из галереи (основное) - сортируем по order_column по возрастанию
                    $firstMedia = $record->getMedia('post-gallery')->sortBy('order_column')->first();
                    if ($firstMedia) {
                        return $firstMedia->getFullUrl('thumb');
                    }
                    return null;
                }),
            TextColumn::make('main_category.name')
                ->label(__('posts.table.columns.category'))
                ->getStateUsing(function ($record) {
                    return $record->main_category?->name;
                }),
            TextColumn::make('views')
                ->label(__('posts.table.columns.views'))
                ->numeric()
                ->sortable(),
            IconColumn::make('is_published')
                ->label(__('posts.table.columns.is_published'))
                ->boolean(),
            TextColumn::make('published_at')
                ->label(__('posts.table.columns.published_at'))
                ->dateTime('d.m.Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
                ->label(__('posts.table.columns.created_at'))
                ->dateTime('d.m.Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->label(__('posts.table.columns.updated_at'))
                ->dateTime('d.m.Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
