<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCountWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
            ->description('All registered users in the system'),
            Stat::make('Total Users from Egypt', User::whereHas(
                'country', fn ($q)=>$q->where('name', 'Egypt'))->count()
            )
            ->description('All registered users from Egypt')
            ->descriptionColor('success'),
            Stat::make('Total Users from United States', User::whereHas(
                'country', fn ($q)=>$q->where('name', 'United States'))->count()
            )
            ->description('All registered users from United States')
            ->descriptionColor('success'),
        ];
    }
}
