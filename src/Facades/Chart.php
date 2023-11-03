<?php

namespace ImReallyUnoriginal\LaravelChartjs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ImReallyUnoriginal\LaravelChartjs\Chart
 */
class Chart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ImReallyUnoriginal\LaravelChartjs\Chart::class;
    }
}
