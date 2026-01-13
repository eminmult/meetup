<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ActionGroup::make([
                Action::make('edit_services_page')
                    ->label(__('services.actions.edit_services_page'))
                    ->icon('heroicon-o-document-text')
                    ->url(function () {
                        $page = Page::where('template', 'services-page')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
                Action::make('edit_service_detail')
                    ->label(__('services.actions.edit_service_detail'))
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->url(function () {
                        $page = Page::where('template', 'service-detail')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
            ])
                ->label(__('services.actions.page_settings'))
                ->icon('heroicon-o-cog-6-tooth')
                ->button()
                ->color('gray'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->with(['media']);
    }
}
