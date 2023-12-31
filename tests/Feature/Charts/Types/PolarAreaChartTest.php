<?php

use ImReallyUnoriginal\PlotTwist\AbstractChart;
use ImReallyUnoriginal\PlotTwist\Chart;

describe('PolarAreaChart', function () {
    it('can be created', function () {
        expect(Chart::polarArea('Test Chart'))->toBeInstanceOf(AbstractChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'polarArea';

        $chart = Chart::polarArea('Test Chart', [$this->datasets['primitive']])
            ->setLabels($this->labels);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['primitive']->toArray());

        $chart->setDatasets([$this->datasets['object']]);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['object']->toArray());

        $chart->setDatasets([$this->datasets['keys']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['keys']->toArray(), [
            'data' => $this->datasets['object']->toArray()['data'],
        ]));
    });
});
