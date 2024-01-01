<?php

namespace ImReallyUnoriginal\PlotTwist\Traits;

use ImReallyUnoriginal\PlotTwist\Helpers\DatasetHelper;

trait PrimitiveFormat
{
    public function __construct($title = null, $datasets = [])
    {
        parent::__construct($title, $datasets);

        $this->formats = [DatasetHelper::PRIMITIVE];
    }
}
