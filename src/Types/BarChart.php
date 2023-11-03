<?php

namespace ImReallyUnoriginal\LaravelChartjs\Types;

use ImReallyUnoriginal\LaravelChartjs\AbstractChart;

class BarChart extends AbstractChart
{
    public function __construct($title = null, $datasets = [])
    {
        parent::__construct('bar', $title, $datasets);
    }

    public static function create($title = null, $datasets = []): static
    {
        return new static($title, $datasets);
    }

    /**
     * Display the chart horizontally.
     */
    public function horizontal(): static
    {
        return $this->mergeOptions([
            'indexAxis' => 'y',
        ]);
    }

    /**
     * Display the chart vertically.
     */
    public function vertical(): static
    {
        return $this->mergeOptions([
            'indexAxis' => 'x',
        ]);
    }

    /**
     * Display the chart with stacked datasets.
     */
    public function stacked(): static
    {
        return $this->mergeOptions([
            'scales' => [
                'xAxes' => [
                    'stacked' => true,
                ],
                'yAxes' => [
                    'stacked' => true,
                ],
            ],
        ]);
    }
}