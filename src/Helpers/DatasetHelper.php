<?php

namespace ImReallyUnoriginal\LaravelChartjs\Helpers;

use Illuminate\Support\Collection;

class DatasetHelper
{
    const PRIMITIVE = 'primitive';

    const KEYS = 'keys';

    const OBJECT = 'object';

    /**
     * Convert the dataset data into object format.
     *
     * @param  array|Collection The dataset data to normalize.
     */
    public static function normalize(array|Collection $data): Collection
    {
        $data = static::toCollection($data);

        if (static::isObject($data)) {
            return $data;
        } elseif (static::isKeys($data) || static::isPrimitive($data)) {
            return $data->map(fn ($y, $x) => compact('x', 'y'))->values();
        } else {
            throw new \InvalidArgumentException('Cannot normalize data in format: '.json_encode($data->first()).'.');
        }
    }

    /**
     * Check if the dataset data is in object format.
     *
     * @param  array|Collection The dataset data to check.
     */
    public static function isObject(array|Collection $data): bool
    {
        return static::toCollection($data)->contains(fn ($value, $key) => is_numeric($key)
            && is_array($value)
            && ! is_numeric(key($value))
        );
    }

    /**
     * Check if the dataset data is in primitive format.
     *
     * @param  array|Collection The dataset data to check.
     */
    public static function isPrimitive(array|Collection $data): bool
    {
        return static::toCollection($data)->contains(fn ($value, $key) => is_numeric($key) && ! is_array($value));
    }

    /**
     * Check if the dataset data is in keys format.
     *
     * @param  array|Collection The dataset data to check.
     */
    public static function isKeys(array|Collection $data): bool
    {
        return static::toCollection($data)->contains(fn ($value, $key) => ! is_numeric($key));
    }

    /**
     * Manually define the dataset's labels
     *
     * @param  array|Collection The dataset data to modify.
     * @param  array|Collection  $labels The labels to use.
     */
    public static function fillLabels(array|Collection $data, array|Collection $labels): Collection
    {
        $labels = static::toCollection($labels);
        $data = static::normalize($data);

        // If the labels are default array indexes, fill in the gaps
        if ($data->pluck('x')->diff(range(0, $data->count() - 1))->isEmpty()) {
            return $labels->map(fn ($label, $i) => [
                'x' => $label,
                'y' => $data->get($i)['y'],
            ]);
        }

        // If labels are set, reorder them and fill in the gaps
        return $labels->map(function ($label) use ($data) {
            $filteredData = $data->filter(function ($data) use ($label) {
                return array_key_exists('x', $data) && $data['x'] === $label;
            });

            return $filteredData->isEmpty()
                ? ['x' => $label, 'y' => 0]
                : $filteredData->first();
        });
    }

    /**
     * Convert the dataset data into primitive format.
     *
     * @param  array|Collection The dataset data to convert.
     */
    public static function toPrimitive(array|Collection $data): Collection
    {
        return static::normalize($data)->pluck('y');
    }

    /**
     * Convert the dataset data into keys format.
     *
     * @param  array|Collection The dataset data to convert.
     */
    public static function toKeys(array|Collection $data): Collection
    {
        return static::normalize($data)->pluck('y', 'x');
    }

    /**
     * Convert the dataset data into object format.
     *
     * @param  array|Collection The dataset data to convert.
     */
    public static function toObject(array|Collection $data): Collection
    {
        return static::normalize($data);
    }

    /**
     * Convert the dataset data into the specified format.
     *
     * @param  array|Collection The dataset data to convert.
     * @param  string  $format The format to convert to.
     */
    public static function format(array|Collection $data, string $format): Collection
    {
        if ($format === static::PRIMITIVE) {
            return static::toPrimitive($data);
        } elseif ($format === static::KEYS) {
            return static::toKeys($data);
        } elseif ($format === static::OBJECT) {
            return static::toObject($data);
        }

        throw new \InvalidArgumentException('Invalid format provided: '.$format.'.');
    }

    /**
     * Convert the dataset data into a collection.
     *
     * @param  array|Collection The dataset data to convert.
     */
    public static function toCollection(array|Collection $data): Collection
    {
        return $data instanceof Collection ? $data : new Collection($data);
    }
}
