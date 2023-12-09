<?php

namespace ImReallyUnoriginal\LaravelChartjs\Types;

use Illuminate\Support\Str;
use ImReallyUnoriginal\LaravelChartjs\AbstractChart;

class AsyncChart extends AbstractChart
{
    /**
     * @var string The chart's source URL.
     */
    protected $source;

    /**
     * @param  string  $source The chart's source URL.
     */
    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     * @param  string  $source The chart's source URL.
     */
    public static function create($source = null): static
    {
        return new static($source);
    }

    public function toHtml(): string
    {
        $id = $this->id ? e($this->id) : Str::random();
        $source = e($this->source);

        return <<<HTML
            <canvas id="$id"></canvas>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    fetch('$source')
                        .then(response => response.json())
                        .then(data => new Chart(document.getElementById('$id'), data));
                });
            </script>
        HTML;
    }
}