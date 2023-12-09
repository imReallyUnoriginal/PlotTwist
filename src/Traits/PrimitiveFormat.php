<?php

namespace ImReallyUnoriginal\LaravelChartjs\Traits;

trait PrimitiveFormat
{
    public function formatData(): void
    {
        parent::formatData();

        foreach ($this->datasets as &$dataset) {
            $dataset->format('primitive');
        }
    }
}
