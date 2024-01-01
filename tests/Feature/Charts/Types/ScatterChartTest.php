<?php

use ImReallyUnoriginal\PlotTwist\AbstractChart;
use ImReallyUnoriginal\PlotTwist\Chart;

describe('ScatterChart', function () {
    it('can be created', function () {
        expect(Chart::scatter('Test Chart'))->toBeInstanceOf(AbstractChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'scatter';

        $chart = Chart::scatter('Test Chart', [$this->datasets['primitive']])
            ->setLabels($this->labels);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['primitive']->toArray(), [
            'data' => $this->datasets['object']->toArray()['data'],
        ]));

        $chart->setDatasets([$this->datasets['object']]);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['object']->toArray());

        $chart->setDatasets([$this->datasets['keys']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['keys']->toArray(), [
            'data' => $this->datasets['object']->toArray()['data'],
        ]));
    });
});
