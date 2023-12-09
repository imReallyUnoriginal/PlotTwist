<?php

namespace ImReallyUnoriginal\LaravelChartjs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Str;
use ImReallyUnoriginal\LaravelChartjs\Helpers\DatasetHelper;

abstract class AbstractChart implements Arrayable, Htmlable, Jsonable
{
    /**
     * @var string The chart's unique identifier.
     */
    protected $id;

    /**
     * @var string The type of chart to render.
     */
    protected $type;

    /**
     * @var Dataset[] The chart datasets.
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
    ];

    /**
     * @var string[] The compatible formats for chart data.
     */
    protected $formats = [
        DatasetHelper::PRIMITIVE,
        DatasetHelper::OBJECT,
    ];

    public function __construct(string $type, ?string $title = null, array $datasets = [])
    {
        $this->setType($type);
        $this->setTitle($title);
        $this->setDatasets($datasets);
    }

    /**
     * @param  string  $type The type of chart to render.
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  Dataset[]  $datasets The chart datasets.
     */
    public function setDatasets(array $datasets): static
    {
        $this->datasets = $datasets;

        return $this;
    }

    /**
     * @return Dataset[]
     */
    public function datasets(): array
    {
        return $this->datasets;
    }

    /**
     * @param  array  $labels The chart labels.
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
     */
    public function mergeOptions(array $options): static
    {
        $this->options = array_merge_recursive($this->options, $options);

        return $this;
    }

    public function options(): array
    {
        return $this->options;
    }

    /**
     * @param  string  $title The chart title.
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
     */
    public function addDataset($label, $data, $options = []): static
    {
        $this->datasets[] = Chart::dataset($label, $data, $options);

        return $this;
    }

    /**
     * Set the required format for the chart data.
     * 
     * @param  string|array  $format The format(s) to use.
     */
    public function format(string|array $formats): static
    {
        foreach ((array) $formats as $format) {
            if (! in_array($format, $this->formats)) {
                throw new \Exception('Conflict in required data formats: Must be '.$format.' and ('.implode(' or ', $this->formats).').');
            }
        }

        $this->formats = (array) $formats;

        return $this;
    }

    /**
     * Format the data for the chart.
     */
    public function formatData(): void
    {
        // If labels are not set, collect them from the datasets.
        if (empty($this->labels)) {
            $this->labels = array_unique(array_reduce($this->datasets, function ($carry, $dataset) {
                return array_merge($carry, $dataset->data()->pluck('x')->toArray());
            }, []));
        } else {
            // If labels are set, ensure that all datasets have the same labels.
            foreach ($this->datasets as $dataset) {
                $dataset->setLabels($this->labels);
            }
        }

        // If the datasets are not in the correct format, convert them.
        if (count($this->formats) == 1) {
            foreach ($this->datasets as &$dataset) {
                $dataset->format($this->formats[0]);
            }
        }
    }

    public function toHtml(): string
    {
        $id = $this->id ? e($this->id) : Str::random();

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
                'datasets' => array_map(function ($dataset) {
                    return $dataset->toArray();
                }, $this->datasets),
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
