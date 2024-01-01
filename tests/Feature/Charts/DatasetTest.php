<?php

use ImReallyUnoriginal\PlotTwist\Dataset;

describe('Dataset', function () {
    it('can be created', function () {
        $dataset = Dataset::create('Test Dataset', [1, 2, 3], ['test' => 'test']);

        expect($dataset)->toBeInstanceOf(Dataset::class);
        expect($dataset->label())->toBe('Test Dataset');
        expect($dataset->data()->toArray())->toBe([
            ['x' => 0, 'y' => 1],
            ['x' => 1, 'y' => 2],
            ['x' => 2, 'y' => 3],
        ]);
        expect($dataset->options())->toBe(['test' => 'test']);
    });
});
