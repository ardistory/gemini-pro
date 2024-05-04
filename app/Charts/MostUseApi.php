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
            ->addData('Text AI', [40, 93, 35, 42, 18, 82])
            ->addData('Image AI', [70, 29, 77, 28, 55, 45])
            ->setTitle('Application usage data')
            ->setSubtitle('Text AI vs Image AI')
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
