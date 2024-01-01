<?php

namespace ImReallyUnoriginal\PlotTwist;

/**
 * @method static Types\AsyncChart async(string $source, int $refreshInterval = 60)
 * @method static Types\BarChart bar(string $title = null, array $datasets = [])
 * @method static Chart bubble(string $title = null, array $datasets = [])
 * @method static Types\DoughnutChart doughnut(string $title = null, array $datasets = [])
 * @method static Chart line(string $title = null, array $datasets = [])
 * @method static Types\PieChart pie(string $title = null, array $datasets = [])
 * @method static Chart polarArea(string $title = null, array $datasets = [])
 * @method static Types\RadarChart radar(string $title = null, array $datasets = [])
 * @method static Chart scatter(string $title = null, array $datasets = [])
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
