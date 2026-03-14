<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadSourceBreakdown extends ChartWidget
{
    protected ?string $heading = 'Lead Source Breakdown';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $rawCounts = Lead::query()
            ->selectRaw('source, count(*) as count')
            ->groupBy('source')
            ->pluck('count', 'source')
            ->toArray();

        $labelsMap = Lead::SOURCES;
        $labels = [];
        $data = [];

        foreach ($labelsMap as $key => $label) {
            $labels[] = $label;
            $data[] = $rawCounts[$key] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59,130,246,0.8)',
                        'rgba(16,185,129,0.8)',
                        'rgba(249,115,22,0.8)',
                        'rgba(245,158,11,0.8)',
                        'rgba(107,114,128,0.8)',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
