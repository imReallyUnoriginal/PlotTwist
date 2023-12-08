<?php

use ImReallyUnoriginal\LaravelChartjs\Tests\ChartTestCase;
use ImReallyUnoriginal\LaravelChartjs\Tests\TestCase;

uses(ChartTestCase::class)->in('Feature/Charts');
// uses(TestCase::class)->in(__DIR__);

expect()->extend('toBeArray', function () {
    return $this->toBeInstanceOf(\Illuminate\Support\Collection::class);
});
