<?php

namespace ImReallyUnoriginal\LaravelChartjs\Traits;

use ImReallyUnoriginal\LaravelChartjs\Helpers\DatasetHelper;

trait PrimitiveFormat
{
    public function __construct($title = null, $datasets = [])
    {
        parent::__construct($title, $datasets);

        $this->formats = [DatasetHelper::PRIMITIVE];
    }
}
