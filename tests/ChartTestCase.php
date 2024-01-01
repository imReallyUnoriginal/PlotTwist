<?php

namespace ImReallyUnoriginal\PlotTwist\Tests;

use ImReallyUnoriginal\PlotTwist\Chart;

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

        $this->labels = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve'];

        $this->datasets = [
            'primitive' => Chart::dataset('Test Primitive[]', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12])->setLabels($this->labels),
            'object' => Chart::dataset('Test Object[]', [
                ['x' => 'One', 'y' => 1],
                ['x' => 'Two', 'y' => 2],
                ['x' => 'Three', 'y' => 3],
                ['x' => 'Four', 'y' => 4],
                ['x' => 'Five', 'y' => 5],
                ['x' => 'Six', 'y' => 6],
                ['x' => 'Seven', 'y' => 7],
                ['x' => 'Eight', 'y' => 8],
                ['x' => 'Nine', 'y' => 9],
                ['x' => 'Ten', 'y' => 10],
                ['x' => 'Eleven', 'y' => 11],
                ['x' => 'Twelve', 'y' => 12],
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
