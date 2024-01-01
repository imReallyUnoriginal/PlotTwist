<?php

namespace ImReallyUnoriginal\PlotTwist\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ImReallyUnoriginal\PlotTwist\Chart
 */
class Chart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ImReallyUnoriginal\PlotTwist\Chart::class;
    }
}
