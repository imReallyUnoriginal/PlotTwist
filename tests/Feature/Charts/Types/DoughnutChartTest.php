<?php

use ImReallyUnoriginal\LaravelChartjs\Chart;
use ImReallyUnoriginal\LaravelChartjs\AbstractChart;

describe('DoughnutChart', function () {
    it('can be created', function () {
        expect(Chart::doughnut('Test Chart'))->toBeInstanceOf(AbstractChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'doughnut';

        $chart = Chart::doughnut('Test Chart', [$this->datasets['primitive']])
            ->setLabels($this->labels);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['primitive']->toArray());

        $chart->setDatasets([$this->datasets['object']]);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['object']->toArray());

        $chart->setDatasets([$this->datasets['keys']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['keys']->toArray(), [
            'data' => $this->datasets['object']->toArray()['data']
        ]));
    });
});
