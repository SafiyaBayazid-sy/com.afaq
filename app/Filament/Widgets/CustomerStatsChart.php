<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CustomerStatsChart extends ChartWidget
{
    protected ?string $heading = 'Customer Statistics (Last 6 Months)';

    protected static ?int $sort = 4;

    protected ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $months = collect();
        $customerCounts = [];

        // Get last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months->push($month->format('M Y'));

            $customerCounts[] = Customer::whereHas('user', function ($query) use ($month) {
                $query->whereYear('created_at', $month->year)
                      ->whereMonth('created_at', $month->month);
            })->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Customers',
                    'data' => $customerCounts,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
