<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ActionGroup::make([
                Action::make('edit_blog_page')
                    ->label(__('posts.actions.edit_blog_page'))
                    ->icon('heroicon-o-document-text')
                    ->url(function () {
                        $page = Page::where('template', 'blog-page')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
                Action::make('edit_blog_detail')
                    ->label(__('posts.actions.edit_blog_detail'))
                    ->icon('heroicon-o-newspaper')
                    ->url(function () {
                        $page = Page::where('template', 'blog-detail')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
            ])
                ->label(__('posts.actions.page_settings'))
                ->icon('heroicon-o-cog-6-tooth')
                ->button()
                ->color('gray'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->with(['media', 'categories', 'category', 'lock.user']);
    }
}
