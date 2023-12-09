<?php

namespace ImReallyUnoriginal\LaravelChartjs\Traits;

use ImReallyUnoriginal\LaravelChartjs\Helpers\DatasetHelper;

trait UsesIndexAxis
{
    /**
     * Display the chart horizontally.
     */
    public function horizontal(): static
    {
        return $this->format(DatasetHelper::PRIMITIVE)
            ->mergeOptions([
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
}
