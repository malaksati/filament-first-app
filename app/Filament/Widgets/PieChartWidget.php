<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PieChartWidget extends ChartWidget
{
    protected ?string $heading = 'Pie Chart Widget';
    protected ?string $subheading = 'A simple pie chart example';
    protected ?string $maxHeight = '250px';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        
        return [
            'datasets' => [
                [
                    'data' => [10, 25, 15, 30, 20],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
