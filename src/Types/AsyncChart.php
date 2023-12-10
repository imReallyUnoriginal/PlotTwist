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
     * @var int The chart's refresh interval in seconds. (0 to disable)
     */
    protected $refreshInterval;

    /**
     * @param  string  $source The chart's source URL.
     * @param  int  $refreshInterval The chart's refresh interval in seconds. (0 to disable)
     */
    public function __construct(string $source, int $refreshInterval = 60)
    {
        $this->source = $source;
        $this->refreshEvery($refreshInterval);
    }

    /**
     * @param  string  $source The chart's source URL.
     */
    public static function create(string $source, int $refreshInterval = 60): static
    {
        return new static($source, $refreshInterval);
    }

    /**
     * Set how often the chart should refresh its data
     *
     * @param  int  $seconds The chart's refresh interval in seconds. (0 to disable)
     */
    public function refreshEvery(int $seconds): static
    {
        $this->refreshInterval = $seconds;

        return $this;
    }

    /**
     * Disable the chart's refresh interval
     */
    public function dontRefresh(): static
    {
        return $this->refreshEvery(0);
    }

    public function toHtml(): string
    {
        $id = $this->id ? e($this->id) : Str::random();
        $source = e($this->source);

        $reloadingJs = $this->refreshInterval
            ? <<<JS
                setInterval(() => {
                    fetch('$source')
                        .then(response => response.json())
                        .then(data => {
                            chart_{$id}.data = data.data;
                            chart_{$id}.options = data.options;
                            chart_{$id}.update()
                        });
                }, {$this->refreshInterval}000);
            JS
            : '';

        return <<<HTML
            <canvas id="$id"></canvas>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    let chart_{$id};

                    fetch('$source')
                        .then(response => response.json())
                        .then(data => chart_{$id} = new Chart(document.getElementById('$id'), data));

                    $reloadingJs
                });
            </script>
        HTML;
    }
}
