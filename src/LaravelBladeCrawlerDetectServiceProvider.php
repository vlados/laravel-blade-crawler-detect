<?php

namespace Vlados\LaravelBladeCrawlerDetect;

use Illuminate\Support\Facades\Blade;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBladeCrawlerDetectServiceProvider extends PackageServiceProvider
{
    public function packageRegistered()
    {
        $this->app->singleton('CrawlerDetect', function () {
            return new \Jaybizzle\CrawlerDetect\CrawlerDetect();
        });
    }

    public function packageBooted()
    {
        Blade::if('user', function () {
             return !app(CrawlerDetect::class)->isCrawler();
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-blade-crawler-detect');
    }
}
