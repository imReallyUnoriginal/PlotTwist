<?php

namespace ImReallyUnoriginal\LaravelChartjs\Helpers;

use Illuminate\Support\Collection;

class DatasetHelper
{
    /**
     * Convert the dataset data into object format.
     *
     * @param  array|Collection The dataset data to normalize.
     */
    public static function normalize(array|Collection $data): array
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        if (static::isObject($data)) {
            return $data;
        } elseif (static::isKeys($data) || static::isPrimitive($data)) {
            return array_map(fn ($x, $y) => compact('x', 'y'), array_keys($data), $data);
        } else {
            throw new \InvalidArgumentException('Invalid data provided.');
        }
    }

    /**
     * Check if the dataset data is in object format.
     *
     * @param  array|Collection The dataset data to check.
     */
    public static function isObject(array|Collection $data): bool
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        return is_array($data)
            && is_numeric(key($data))
            && is_array($data[0])
            && ! is_numeric(key($data[0]));
    }

    /**
     * Check if the dataset data is in primitive format.
     *
     * @param  array|Collection The dataset data to check.
     */
    public static function isPrimitive(array|Collection $data): bool
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        return is_array($data)
            && is_numeric(key($data))
            && ! is_array($data[key($data)]);
    }

    /**
     * Check if the dataset data is in keys format.
     *
     * @param  array|Collection The dataset data to check.
     */
    public static function isKeys(array|Collection $data): bool
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        return is_array($data) &&
            ! is_numeric(key($data));
    }

    /**
     * Manually define the dataset's labels
     *
     * @param  array|Collection The dataset data to modify.
     * @param  array|Collection $labels The labels to use.
     */
    public static function fillLabels(array|Collection $data, array|Collection $labels): array
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        if ($labels instanceof Collection) {
            $labels = $labels->toArray();
        }

        $data = static::normalize($data);

        // If the labels are default array indexes, fill in the gaps
        if (array_column($data, 'x') === range(0, count($data) - 1)) {
            return array_map(function ($x, $y) {
                return compact('x', 'y');
            }, $labels, array_column($data, 'y'));
        }

        // If labels are set, reorder them and fill in the gaps
        return array_map(function ($label) use ($data) {
            $data = array_filter($data, function ($data) use ($label) {
                return array_key_exists('x', $data) && $data['x'] === $label;
            });

            if (empty($data)) {
                return ['x' => $label, 'y' => 0];
            }

            return array_shift($data);
        }, $labels);
    }
}
