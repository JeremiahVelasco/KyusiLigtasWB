<?php

namespace App\Filament\Resources\ReportResource\Widgets;

use App\Models\Report;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pendingReports = Report::where('status', 'Pending')->count();
        $inProgressReports = Report::where('status', 'In Progress')->count();
        $resolvedReports = Report::where('status', 'In Progress')->count();
        $cancelledReports = Report::where('status', 'Cancelled')->count();

        return [
            Stat::make('Pending Reports', $pendingReports),
            Stat::make('In Progress Reports', $inProgressReports),
            Stat::make('Resolved Reports', $resolvedReports),
            Stat::make('Cancelled Reports', $cancelledReports),
        ];
    }
}
