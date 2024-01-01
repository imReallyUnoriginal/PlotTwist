<?php

use ImReallyUnoriginal\PlotTwist\Chart;
use ImReallyUnoriginal\PlotTwist\Types\DoughnutChart;

describe('DoughnutChart', function () {
    it('can be created', function () {
        expect(Chart::doughnut('Test Chart'))->toBeInstanceOf(DoughnutChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'doughnut';

        $chart = Chart::doughnut('Test Chart', [$this->datasets['primitive']])
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
