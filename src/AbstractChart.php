<?php

namespace ImReallyUnoriginal\LaravelChartjs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Str;

abstract class AbstractChart implements Arrayable, Htmlable, Jsonable
{
    /**
     * @var string The type of chart to render.
     */
    protected $type;

    /**
     * @var array The chart datasets.
     */
    protected $datasets = [];

    /**
     * @var string[] The chart labels.
     */
    protected $labels = [];

    /**
     * @var array The chart options.
     */
    protected $options = [];

    /**
     * @var string Default chart options.
     */
    protected $defaultOptions = [
        'fullscreen' => true,
        'parsing' => [
            'xAxisKey' => 'label',
            'yAxisKey' => 'value',
        ],
    ];

    public function __construct(string $type, string $title = null, array $datasets = [])
    {
        $this->setType($type);
        $this->setTitle($title);
        $this->setDatasets($datasets);
    }

    /**
     * @param  string  $type The type of chart to render.
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  array  $datasets The chart datasets.
     * @return $this
     */
    public function setDatasets(array $datasets): static
    {
        $this->datasets = $datasets;

        return $this;
    }

    /**
     * @return array
     */
    public function datasets(): array
    {
        return $this->datasets;
    }

    /**
     * @param  array  $labels The chart labels.
     * @return $this
     */
    public function setLabels(array $labels): static
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @return string[]
     */
    public function labels(): array
    {
        return $this->labels;
    }

    /**
     * @param  array  $options The chart options.
     * @return $this
     */
    public function setOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Merge the given options with the existing options.
     *
     * @param  array  $options The chart options.
     * @return $this
     */
    public function mergeOptions(array $options): static
    {
        $this->options = array_merge_recursive($this->options, $options);

        return $this;
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * @param  string  $title The chart title.
     * @return $this
     */
    public function setTitle(string $title): static
    {
        return $this->mergeOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => $title,
                ],
            ],
        ]);
    }

    /**
     * @param  string  $label The dataset label.
     * @param  array  $data The dataset data.
     * @param  array  $options The dataset options.
     * @return $this
     */
    public function addDataset($label, $data, $options = []): static
    {
        $this->datasets[] = Chart::dataset($label, $data, $options);

        return $this;
    }

    /**
     * Format the data for the chart.
     */
    public function formatData(): void
    {
        // If labels are not set, collect them from the datasets.
        if (empty($this->labels)) {
            $this->labels = collect($this->datasets)
                ->pluck('data')
                ->flatten(1)
                ->pluck('label')
                ->unique()
                ->values()
                ->all();
        }
    }

    public function toHtml(): string
    {
        $id = Str::random();

        return <<<HTML
            <canvas id="$id"></canvas>
            <script>new Chart(document.getElementById('$id'), {$this->toJson()});</script>
        HTML;
    }

    public function toArray(): array
    {
        $this->formatData();

        return [
            'type' => $this->type,
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->datasets,
            ],
            'options' => array_merge_recursive($this->defaultOptions, $this->options),
        ];
    }

    /**
     * @param  int  $options
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
