<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectsChart extends ChartWidget
{
    protected  ?string $heading = 'Projects Distribution';

        protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Get counts by status
        $projectsByStatus = Project::selectRaw('project_status, count(*) as count')
            ->groupBy('project_status')
            ->pluck('count', 'project_status')
            ->toArray();

        $statusLabels = [
            'on_hold' => 'On Hold',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Projects by Status',
                    'data' => array_values($projectsByStatus),
                    'backgroundColor' => [
                        'rgba(255, 205, 86, 0.8)',   // On Hold - Yellow
                        'rgba(54, 162, 235, 0.8)',    // In Progress - Blue
                        'rgba(75, 192, 192, 0.8)',     // Completed - Green
                    ],
                    'borderColor' => [
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 235)',
                        'rgb(75, 192, 192)',
                    ],
                ],
            ],
            'labels' => array_map(function($status) use ($statusLabels) {
                return $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status));
            }, array_keys($projectsByStatus)),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
