<?php

use ImReallyUnoriginal\PlotTwist\Tests\ChartTestCase;

uses(ChartTestCase::class)->in('Feature/Charts');

expect()->extend('toBeArray', function () {
    return $this->toBeInstanceOf(\Illuminate\Support\Collection::class);
});
