<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use App\Models\Booking;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $customersThisWeek = Customer::whereHas('user', function ($query) {
            $query->where('created_at', '>=', now()->subWeek());
        })->count();

        $newInquiries = Inquiry::where('status', 'new')->count();
        $upcomingBookings = Booking::where('status', 'upcoming')->count();

        return [
            Stat::make('Total Customers', Customer::count())
                ->description("+{$customersThisWeek} this week")
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Total Inquiries', Inquiry::count())
                ->description("{$newInquiries} new")
                ->descriptionIcon('heroicon-m-chat-bubble-left')
                ->color('warning'),

            Stat::make('Total Bookings', Booking::count())
                ->description("{$upcomingBookings} upcoming")
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Active Customers', Customer::whereHas('user', function ($query) {
                $query->where('is_active', true);
            })->count())
                ->description('Currently active')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
