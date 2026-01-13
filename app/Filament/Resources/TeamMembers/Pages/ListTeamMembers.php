<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Resources\TeamMembers\TeamMemberResource;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTeamMembers extends ListRecords
{
    protected static string $resource = TeamMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ActionGroup::make([
                Action::make('edit_team_page')
                    ->label(__('team.actions.edit_team_page'))
                    ->icon('heroicon-o-document-text')
                    ->url(function () {
                        $page = Page::where('template', 'team-page')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
                Action::make('edit_team_detail')
                    ->label(__('team.actions.edit_team_detail'))
                    ->icon('heroicon-o-user')
                    ->url(function () {
                        $page = Page::where('template', 'team-detail')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
            ])
                ->label(__('team.actions.page_settings'))
                ->icon('heroicon-o-cog-6-tooth')
                ->button()
                ->color('gray'),
        ];
    }
}
