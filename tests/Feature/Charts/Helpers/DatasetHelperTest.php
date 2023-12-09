<?php

use ImReallyUnoriginal\LaravelChartjs\Helpers\DatasetHelper;

describe('DatasetHelper', function () {
    $primitiveData = [
        1,
        2,
        3,
    ];
    $objectData = [
        ['x' => 'A', 'y' => 1],
        ['x' => 'B', 'y' => 2],
        ['x' => 'C', 'y' => 3],
    ];
    $keyedData = [
        'A' => 1,
        'B' => 2,
        'C' => 3,
    ];

    it('can normalize a dataset', function () use ($primitiveData, $objectData, $keyedData) {
        expect(DatasetHelper::normalize($primitiveData)->toArray())->toBe([
            ['x' => 0, 'y' => 1],
            ['x' => 1, 'y' => 2],
            ['x' => 2, 'y' => 3],
        ]);
        expect(DatasetHelper::normalize(collect($primitiveData))->toArray())->toBe([
            ['x' => 0, 'y' => 1],
            ['x' => 1, 'y' => 2],
            ['x' => 2, 'y' => 3],
        ]);

        expect(DatasetHelper::normalize($objectData)->toArray())->toBe($objectData);
        expect(DatasetHelper::normalize(collect($objectData))->toArray())->toBe($objectData);

        expect(DatasetHelper::normalize($keyedData)->toArray())->toBe($objectData);
        expect(DatasetHelper::normalize(collect($keyedData))->toArray())->toBe($objectData);
    });

    it('can check if a dataset is in primitive format', function () use ($primitiveData, $objectData, $keyedData) {
        expect(DatasetHelper::isPrimitive($primitiveData))->toBeTrue();
        expect(DatasetHelper::isPrimitive(collect($primitiveData)))->toBeTrue();

        expect(DatasetHelper::isPrimitive($objectData))->toBeFalse();
        expect(DatasetHelper::isPrimitive(collect($objectData)))->toBeFalse();

        expect(DatasetHelper::isPrimitive($keyedData))->toBeFalse();
        expect(DatasetHelper::isPrimitive(collect($keyedData)))->toBeFalse();
    });

    it('can check if a dataset is in object format', function () use ($primitiveData, $objectData, $keyedData) {
        expect(DatasetHelper::isObject($primitiveData))->toBeFalse();
        expect(DatasetHelper::isObject(collect($primitiveData)))->toBeFalse();

        expect(DatasetHelper::isObject($objectData))->toBeTrue();
        expect(DatasetHelper::isObject(collect($objectData)))->toBeTrue();

        expect(DatasetHelper::isObject($keyedData))->toBeFalse();
        expect(DatasetHelper::isObject(collect($keyedData)))->toBeFalse();
    });

    it('can check if a dataset is in keyed format', function () use ($primitiveData, $objectData, $keyedData) {
        expect(DatasetHelper::isKeys($primitiveData))->toBeFalse();
        expect(DatasetHelper::isKeys(collect($primitiveData)))->toBeFalse();

        expect(DatasetHelper::isKeys($objectData))->toBeFalse();
        expect(DatasetHelper::isKeys(collect($objectData)))->toBeFalse();

        expect(DatasetHelper::isKeys($keyedData))->toBeTrue();
        expect(DatasetHelper::isKeys(collect($keyedData)))->toBeTrue();
    });

    it('can fill labels', function () use ($primitiveData, $objectData, $keyedData) {
        $sortedObjectData = [
            ['x' => 'C', 'y' => 3],
            ['x' => 'B', 'y' => 2],
            ['x' => 'A', 'y' => 1],
        ];
        expect(DatasetHelper::fillLabels($primitiveData, ['C', 'B', 'A'])->toArray())->toBe([['x' => 'C', 'y' => 1], ['x' => 'B', 'y' => 2], ['x' => 'A', 'y' => 3]]);
        expect(DatasetHelper::fillLabels(collect($primitiveData), collect(['C', 'B', 'A']))->toArray())->toBe([['x' => 'C', 'y' => 1], ['x' => 'B', 'y' => 2], ['x' => 'A', 'y' => 3]]);

        expect(DatasetHelper::fillLabels($objectData, ['C', 'B', 'A'])->toArray())->toBe($sortedObjectData);
        expect(DatasetHelper::fillLabels(collect($objectData), collect(['C', 'B', 'A']))->toArray())->toBe($sortedObjectData);

        expect(DatasetHelper::fillLabels($keyedData, ['C', 'B', 'A'])->toArray())->toBe($sortedObjectData);
        expect(DatasetHelper::fillLabels(collect($keyedData), collect(['C', 'B', 'A']))->toArray())->toBe($sortedObjectData);
    });
});
