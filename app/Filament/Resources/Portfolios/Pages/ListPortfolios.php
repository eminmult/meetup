<?php

namespace App\Filament\Resources\Portfolios\Pages;

use App\Filament\Resources\Portfolios\PortfolioResource;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortfolios extends ListRecords
{
    protected static string $resource = PortfolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ActionGroup::make([
                Action::make('edit_portfolio_page')
                    ->label(__('portfolio.actions.edit_portfolio_page'))
                    ->icon('heroicon-o-document-text')
                    ->url(function () {
                        $page = Page::where('template', 'portfolio-page')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
                Action::make('edit_portfolio_detail')
                    ->label(__('portfolio.actions.edit_portfolio_detail'))
                    ->icon('heroicon-o-photo')
                    ->url(function () {
                        $page = Page::where('template', 'portfolio-detail')->first();
                        if ($page) {
                            return route('filament.admin.resources.pages.edit', ['record' => $page]);
                        }
                        return route('filament.admin.resources.pages.create');
                    }),
            ])
                ->label(__('portfolio.actions.page_settings'))
                ->icon('heroicon-o-cog-6-tooth')
                ->button()
                ->color('gray'),
        ];
    }
}
