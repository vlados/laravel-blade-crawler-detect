<?php

namespace Vlados\LaravelBladeCrawlerDetect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vlados\LaravelBladeCrawlerDetect\LaravelBladeCrawlerDetect
 */
class LaravelBladeCrawlerDetect extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Vlados\LaravelBladeCrawlerDetect\LaravelBladeCrawlerDetect::class;
    }
}
