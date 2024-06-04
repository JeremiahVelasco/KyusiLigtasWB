<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $pendingReports = Report::where('status', 'Pending')->count();
        $inProgressReports = Report::where('status', 'In Progress')->count();
        $resolvedReports = Report::where('status', 'Resolved')->count();
        $cancelledReports = Report::where('status', 'Cancelled')->count();

        return [
            Stat::make('Pending Reports', $pendingReports)
                ->icon('heroicon-m-exclamation-circle')
                ->description('Attend to immediately!')
                ->color('danger'),
            Stat::make('In Progress Reports', $inProgressReports)
                ->icon('heroicon-m-clock')
                ->description('Please wait patiently')
                ->color('warning'),
            Stat::make('Resolved Reports', $resolvedReports)
                ->icon('heroicon-m-check-circle')
                ->description('Great job!')
                ->color('success'),
            Stat::make('Cancelled Reports', $cancelledReports)
                ->icon('heroicon-m-x-circle'),
        ];
    }
}
