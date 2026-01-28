<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget as BaseChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;

use function Termwind\parse;

class ChartWidget extends BaseChartWidget
{
    use InteractsWithPageFilters;
    protected ?string $heading = 'Chart Widget';
    protected ?string $subheading = 'A simple line chart example';
    protected ?string $maxHeight = '250px';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;
        $start = $startDate ? now()->parse($startDate) : now()->startOfYear();
        $end = $endDate ? now()->parse($endDate) : now()->endOfYear();
        $data = Trend::model(User::class)
            ->between(
                $start,
                $end
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Users Created',
                    'data' => $data->map(fn ($item) => $item->aggregate),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->map(fn ($item) => $item->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
