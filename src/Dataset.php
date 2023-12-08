<?php

namespace ImReallyUnoriginal\LaravelChartjs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use ImReallyUnoriginal\LaravelChartjs\Helpers\DatasetHelper;

class Dataset implements Arrayable
{
    /**
     * @var string The dataset label.
     */
    protected $label;

    /**
     * @var array{x?: string, y: integer}[] The dataset data.
     */
    protected $data = [];

    /**
     * @var callable The dataset data formatter.
     */
    protected $formatter;

    /**
     * @var array The dataset options.
     */
    protected $options;

    public function __construct(string $label, array|Collection $data, array $options = [])
    {
        $this->label = $label;
        $this->setData($data);
        $this->options = $options;
    }

    /**
     * @param  string The dataset label.
     * @param  array The dataset data.
     * @param  array The dataset options.
     * @return static
     */
    public static function create($label, $data, $options = []): static
    {
        return new static($label, $data, $options);
    }

    /**
     * @param  array|Collection The dataset data.
     * @return $this
     */
    public function setData(array|Collection $data): static
    {
        $this->data = DatasetHelper::normalize($data);

        return $this;
    }

    /**
     * Manually define the dataset axis labels.
     * This is useful when the data array is primitive.
     * 
     * @param  array|Collection The dataset labels
     * @return $this
     */
    public function setLabels(array|Collection $labels): static
    {
        $this->data = DatasetHelper::fillLabels($this->data, $labels);

        return $this;
    }

    /**
     * @return string
     */
    public function label(): string
    {
        return $this->label;
    }

    /**
     * @return array{x?: string, y: integer}[]
     */
    public function data(): array
    {
        return $this->formatter
            ? call_user_func($this->formatter)
            : $this->data;
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * Define the format of the dataset data.
     *
     * @param  string  $format The format to use.
     * @return $this
     */
    public function format($format = 'object'): static
    {
        if ($format === 'object') {
            $this->formatter = fn () => $this->data;
        } elseif ($format === 'primitive') {
            $this->formatter = fn () => array_column($this->data, 'y');
        } elseif ($format === 'keys') {
            $this->formatter = fn () => array_combine(array_column($this->data, 'x'), array_column($this->data, 'y'));
        } else {
            throw new \Exception('Invalid format provided.');
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label(),
            'data' => $this->data(),
            'options' => $this->options(),
        ];
    }
}
