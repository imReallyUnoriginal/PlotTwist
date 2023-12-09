<?php

namespace ImReallyUnoriginal\LaravelChartjs;

/**
 * @method static Types\AsyncChart async($title = null)
 * @method static Types\BarChart bar($title = null, $datasets = [], $labels = [])
 * @method static Chart bubble($title = null, $datasets = [], $labels = [])
 * @method static Types\DoughnutChart doughnut($title = null, $datasets = [], $labels = [])
 * @method static Chart line($title = null, $datasets = [], $labels = [])
 * @method static Types\PieChart pie($title = null, $datasets = [], $labels = [])
 * @method static Chart polarArea($title = null, $datasets = [], $labels = [])
 * @method static Types\RadarChart radar($title = null, $datasets = [], $labels = [])
 * @method static Chart scatter($title = null, $datasets = [], $labels = [])
 */
class Chart extends AbstractChart
{
    /**
     * @param  string  $type The type of chart to render.
     * @param  string|null  $title The chart title.
     * @param  array  $datasets The chart datasets.
     */
    public static function create($type, $title = null, $datasets = []): static
    {
        return new static($type, $title, $datasets);
    }

    /**
     * @param  string  $label The dataset label.
     * @param  array  $data The dataset data.
     * @param  array  $options The dataset options.
     */
    public static function dataset($label, $data, $options = []): Dataset
    {
        return Dataset::create($label, $data, $options);
    }

    public static function __callStatic($name, $arguments): AbstractChart
    {
        return class_exists($class = __NAMESPACE__.'\\Types\\'.ucfirst($name).'Chart')
            ? new $class(...$arguments)
            : static::create($name, ...$arguments);
    }
}
