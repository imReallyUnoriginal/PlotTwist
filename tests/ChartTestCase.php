<?php

namespace ImReallyUnoriginal\LaravelChartjs\Tests;

use ImReallyUnoriginal\LaravelChartjs\Chart;

abstract class ChartTestCase extends TestCase
{
    /**
     * @var array
     */
    protected $datasets = [];

    /**
     * @var string[]
     */
    protected $labels = [];

    /**
     * @var string
     */
    protected $type;

    protected function setUp(): void
    {
        parent::setUp();

        $this->datasets = [
            'primitive' => Chart::dataset('Test Primitive[]', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'object' => Chart::dataset('Test Object[]', [
                ['label' => 'One', 'value' => 1],
                ['label' => 'Two', 'value' => 2],
                ['label' => 'Three', 'value' => 3],
                ['label' => 'Four', 'value' => 4],
                ['label' => 'Five', 'value' => 5],
                ['label' => 'Six', 'value' => 6],
                ['label' => 'Seven', 'value' => 7],
                ['label' => 'Eight', 'value' => 8],
                ['label' => 'Nine', 'value' => 9],
                ['label' => 'Ten', 'value' => 10],
                ['label' => 'Eleven', 'value' => 11],
                ['label' => 'Twelve', 'value' => 12],
            ]),
            'keys' => Chart::dataset('Test Keys', [
                'One' => 1,
                'Two' => 2,
                'Three' => 3,
                'Four' => 4,
                'Five' => 5,
                'Six' => 6,
                'Seven' => 7,
                'Eight' => 8,
                'Nine' => 9,
                'Ten' => 10,
                'Eleven' => 11,
                'Twelve' => 12,
            ]),
        ];

        $this->labels = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve'];
    }

    protected function expectsChartToMatch(array $chart, array $expectedDataset): void
    {
        expect($chart)->toBeArray();
        expect($chart)->toHaveCount(3);
        expect($chart['type'])->toBe($this->type);
        expect($chart['data'])->toBeArray();
        expect($chart['data']['labels'])->toBe($this->labels);
        expect($chart['data']['datasets'])->toBeArray();
        expect($chart['data']['datasets'])->toHaveCount(1);
        expect($chart['data']['datasets'][0])->toBeArray();
        expect($chart['data']['datasets'][0]['label'])->toBe($expectedDataset['label']);
        expect($chart['data']['datasets'][0]['data'])->toBe($expectedDataset['data']);
        expect($chart['options'])->toBeArray();
    }
}
