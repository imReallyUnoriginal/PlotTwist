<?php

namespace ImReallyUnoriginal\LaravelChartjs\Types;

use ImReallyUnoriginal\LaravelChartjs\AbstractChart;

class RadarChart extends AbstractChart
{
    public function __construct($title = null, $datasets = [])
    {
        parent::__construct('radar', $title, $datasets);
    }

    public static function create($title = null, $datasets = []): static
    {
        return new static($title, $datasets);
    }

    public function formatData(): void
    {
        parent::formatData();

        foreach ($this->datasets as &$dataset) {
            $dataset->format('primitive');
        }
    }
}
