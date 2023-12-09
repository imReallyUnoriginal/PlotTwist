<?php

namespace ImReallyUnoriginal\LaravelChartjs\Types;

use ImReallyUnoriginal\LaravelChartjs\AbstractChart;

class TypedChart extends AbstractChart
{
    public function __construct($title = null, $datasets = [])
    {
        $type = str_replace('Chart', '', static::class);
        $type = preg_replace('/^.*\\\\/', '', $type);
        parent::__construct(strtolower($type), $title, $datasets);
    }

    public static function create($title = null, $datasets = []): static
    {
        return new static($title, $datasets);
    }
}
