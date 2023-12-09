<?php

namespace ImReallyUnoriginal\LaravelChartjs\Types;

class BarChart extends TypedChart
{
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
