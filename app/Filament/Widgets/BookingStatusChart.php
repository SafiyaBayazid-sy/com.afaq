<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class BookingStatusChart extends ChartWidget
{
    protected ?string $heading = 'Booking Status Distribution';

    protected static ?int $sort = 5;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $bookingsByStatus = Booking::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        $statusLabels = [
            'upcoming' => 'Upcoming',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        $data = [];
        $labels = [];

        foreach ($statusLabels as $status => $label) {
            $labels[] = $label;
            $data[] = $bookingsByStatus[$status] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',  // Blue for upcoming
                        'rgba(34, 197, 94, 0.8)',   // Green for completed
                        'rgba(239, 68, 68, 0.8)',   // Red for cancelled
                    ],
                    'borderColor' => [
                        'rgba(59, 130, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
