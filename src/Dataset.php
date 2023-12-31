<?php

namespace ImReallyUnoriginal\PlotTwist;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use ImReallyUnoriginal\PlotTwist\Helpers\DatasetHelper;

class Dataset implements Arrayable
{
    /**
     * @var string The dataset label.
     */
    protected $label;

    /**
     * @var Collection The dataset data.
     */
    protected $data = [];

    /**
     * @var string The format to use for the dataset data.
     */
    protected $format;

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

    public function label(): string
    {
        return $this->label;
    }

    public function data(): Collection
    {
        return $this->format
            ? DatasetHelper::format($this->data, $this->format)
            : DatasetHelper::toCollection($this->data);
    }

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
    public function format($format): static
    {
        $this->format = $format;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label(),
            'data' => $this->data()->toArray(),
            'options' => $this->options(),
        ];
    }
}
