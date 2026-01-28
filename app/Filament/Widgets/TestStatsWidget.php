<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Month;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class TestStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;
        return [
            Stat::make('Total Users', User::query()
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->count(),)
                ->description('Number of users conducted')
                ->descriptionIcon(Heroicon::CheckCircle, IconPosition::Before)
                ->descriptionColor('success')
                // ->chart([10, 25, 15, 30, 20])->color('success')
                ->chart(
                    User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupByRaw('month')
                        ->orderByRaw('month')
                        ->pluck('count')
                        ->toArray()
                )->color('success'),

            Stat::make('Pending Users', 25)
                ->description('Users pending review')
                ->descriptionIcon(Heroicon::Clock, IconPosition::Before)
                ->color('warning')->chart([10, 25, 15, 30, 20])->color('warning'),
                // ->chart(
                //     User::selectRaw('COUNT(*) as count')
                //         ->where('status', 'pending')
                //         ->groupByRaw('DATE(created_at)')
                //         ->orderByRaw('DATE(created_at)')
                //         ->pluck('count')
                //         ->toArray()
                // )->color('warning'),

            Stat::make('Failed Users', 10)
                ->description('Users that did not pass')
                ->descriptionIcon(Heroicon::XCircle, IconPosition::Before)
                ->color('danger')->chart([10, 25, 15, 30, 20])->color('danger'),
                // ->chart(
                //     User::selectRaw('COUNT(*) as count')
                //         ->where('status', 'failed')
                //         ->groupByRaw('DATE(created_at)')
                //         ->orderByRaw('DATE(created_at)')
                //         ->pluck('count')
                //         ->toArray()
                // )->color('danger'),
        ];
    }
}