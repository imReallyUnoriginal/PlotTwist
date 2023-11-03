<?php

use ImReallyUnoriginal\LaravelChartjs\Chart;
use ImReallyUnoriginal\LaravelChartjs\AbstractChart;

describe('PolarAreaChart', function () {
    it('can be created', function () {
        expect(Chart::polarArea('Test Chart'))->toBeInstanceOf(AbstractChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'polarArea';

        $chart = Chart::polarArea('Test Chart', [$this->datasets['primitive']])
            ->setLabels($this->labels);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['primitive']);

        $chart->setDatasets([$this->datasets['object']]);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['object']);

        $chart->setDatasets([$this->datasets['keys']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['keys'], [
            'data' => $this->datasets['object']['data']
        ]));
    });
});
