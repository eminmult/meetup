<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ActionGroup::make([
                Action::make('edit_events_page')
                    ->label(__('events.actions.edit_events_page'))
                    ->icon('heroicon-o-document-text')
                    ->url(function () {
                        $page = Page::where('template', 'events-page')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
                Action::make('edit_event_detail')
                    ->label(__('events.actions.edit_event_detail'))
                    ->icon('heroicon-o-calendar')
                    ->url(function () {
                        $page = Page::where('template', 'event-detail')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
            ])
                ->label(__('events.actions.page_settings'))
                ->icon('heroicon-o-cog-6-tooth')
                ->button()
                ->color('gray'),
        ];
    }
}
