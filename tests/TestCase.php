<?php

namespace Vlados\LaravelBladeCrawlerDetect\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Vlados\LaravelBladeCrawlerDetect\LaravelBladeCrawlerDetectServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelBladeCrawlerDetectServiceProvider::class,
        ];
    }
}
