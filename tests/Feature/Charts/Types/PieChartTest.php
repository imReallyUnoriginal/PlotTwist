<?php

use ImReallyUnoriginal\PlotTwist\Chart;
use ImReallyUnoriginal\PlotTwist\Types\PieChart;

describe('PieChart', function () {
    it('can be created', function () {
        expect(Chart::pie('Test Chart'))->toBeInstanceOf(PieChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'pie';

        $chart = Chart::pie('Test Chart', [$this->datasets['primitive']])
            ->setLabels($this->labels);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['primitive']->toArray(), [
            'data' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        ]));

        $chart->setDatasets([$this->datasets['object']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['object']->toArray(), [
            'data' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        ]));

        $chart->setDatasets([$this->datasets['keys']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['keys']->toArray(), [
            'data' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        ]));
    });
});
