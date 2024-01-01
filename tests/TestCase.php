<?php

namespace ImReallyUnoriginal\PlotTwist\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use ImReallyUnoriginal\PlotTwist\PlotTwistServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'ImReallyUnoriginal\\PlotTwist\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            PlotTwistServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
