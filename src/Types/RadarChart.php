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

        // Radar charts don't support object datasets, so we need to convert their data
        // to arrays in the same order as the labels.
        foreach ($this->datasets as &$dataset) {
            if (is_array($dataset['data'][0])) {
                $newData = array_column($dataset['data'], 'value', 'label');
                $dataset['data'] = array_values($newData);
            }
        }
    }
}
