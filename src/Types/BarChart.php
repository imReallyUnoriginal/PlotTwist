<?php

namespace ImReallyUnoriginal\PlotTwist\Types;

use ImReallyUnoriginal\PlotTwist\Traits\UsesIndexAxis;

class BarChart extends TypedChart
{
    use UsesIndexAxis;

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
