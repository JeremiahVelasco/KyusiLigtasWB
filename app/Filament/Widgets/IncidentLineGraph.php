<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Carbon\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class IncidentLineGraph extends ApexChartWidget
{
    protected static ?int $sort = 4;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'incidentLineGraph';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Incident Line Graph';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Get the current year
        $currentYear = Carbon::now()->year;

        // Initialize an array to hold the monthly data
        $monthlyData = array_fill(0, 12, 0);

        // Retrieve the reports and group by month
        $reports = Report::selectRaw('MONTH(date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        // Populate the monthly data array
        foreach ($reports as $report) {
            $monthlyData[$report->month - 1] = $report->count;
        }

        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'IncidentLineGraph',
                    'data' => $monthlyData,
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
