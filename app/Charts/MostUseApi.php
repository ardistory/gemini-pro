<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MostUseApi
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->addData('Text AI', [4, 9, 3, 4, 1, 8])
            ->addData('Image AI', [7, 2, 7, 2, 5, 4])
            ->setTitle('Application usage data')
            ->setSubtitle('Text AI vs Image AI')
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
