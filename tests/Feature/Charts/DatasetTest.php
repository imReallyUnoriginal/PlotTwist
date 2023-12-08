<?php

use ImReallyUnoriginal\LaravelChartjs\Dataset;

describe('Dataset', function () {
    it('can be created', function () {
        $dataset = Dataset::create('Test Dataset', [1, 2, 3], ['test' => 'test']);

        expect($dataset)->toBeInstanceOf(Dataset::class);
        expect($dataset->label())->toBe('Test Dataset');
        expect($dataset->data())->toBe([
            ['y' => 1],
            ['y' => 2],
            ['y' => 3],
        ]);
        expect($dataset->options())->toBe(['test' => 'test']);
    });
});