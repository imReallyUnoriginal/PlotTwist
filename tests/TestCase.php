<?php

namespace ImReallyUnoriginal\LaravelChartjs\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use ImReallyUnoriginal\LaravelChartjs\LaravelChartjsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'ImReallyUnoriginal\\LaravelChartjs\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelChartjsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-chartjs_table.php.stub';
        $migration->up();
        */
    }
}
