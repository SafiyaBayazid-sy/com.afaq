<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalLeads = Lead::query()->count();
        $newInquiries = Inquiry::query()->where('status', 'new')->count();
        $upcomingBookings = Booking::query()
            ->where('status', 'upcoming')
            ->whereDate('booking_date', '>=', now()->toDateString())
            ->count();

        return [
            Stat::make('Total Leads', $totalLeads)
                ->description('All channels')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('primary'),

            Stat::make('New Inquiries', $newInquiries)
                ->description('Awaiting handling')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('warning'),

            Stat::make('Upcoming Bookings', $upcomingBookings)
                ->description('Future appointments')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),
        ];
    }
}
