<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;





class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';


    // protected static ?string $title = 'لوحة التحكم';

    protected static ?int $navigationSort = 1;

    // If you need to customize the view, do it in getView() method
    public function getView(): string
    {
        return 'filament.pages.dashboard'; // Or your custom view
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\LeadSourceBreakdown::class,
            \App\Filament\Widgets\LatestInquiries::class,
            \App\Filament\Widgets\LatestBookings::class,
        ];
    }


    // public function getColumns(): int | string | array
    // {
    //     return [
    //         'md' => 2, // 2 columns on medium screens and above
    //         'sm' => 1, // 1 column on small screens
    //     ];
    // }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('settings')
                ->label('الإعدادات')
                ->icon('heroicon-o-cog-6-tooth')
                ->url(route('filament.admin.resources.settings.index')),
        ];
    }
}
