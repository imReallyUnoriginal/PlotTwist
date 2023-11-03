<?php

use ImReallyUnoriginal\LaravelChartjs\Chart;
use ImReallyUnoriginal\LaravelChartjs\Types\RadarChart;

describe('RadarChart', function () {
    it('can be created', function () {
        expect(Chart::radar('Test Chart'))->toBeInstanceOf(RadarChart::class);
    });

    it('is arrayable', function () {
        $this->type = 'radar';

        $chart = Chart::radar('Test Chart', [$this->datasets['primitive']])
            ->setLabels($this->labels);
        $this->expectsChartToMatch($chart->toArray(), $this->datasets['primitive']);

        $chart->setDatasets([$this->datasets['object']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['object'], [
            'data' => $this->datasets['primitive']['data']
        ]));

        $chart->setDatasets([$this->datasets['keys']]);
        $this->expectsChartToMatch($chart->toArray(), array_merge($this->datasets['keys'], [
            'data' => $this->datasets['primitive']['data']
        ]));
    });
});
