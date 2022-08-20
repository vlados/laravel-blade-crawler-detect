<?php

namespace Vlados\LaravelBladeCrawlerDetect;

use Illuminate\Support\Facades\Blade;
use Jaybizzle\CrawlerDetect\Fixtures\Crawlers;
use Jaybizzle\CrawlerDetect\Fixtures\Exclusions;
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
        $crawlerDetect = app(\Jaybizzle\CrawlerDetect\CrawlerDetect::class);

        $crawlers = new Crawlers();
        $exclusions = new Exclusions();

        $crawlerList = $crawlers->getAll();
        $crawlerList[] = 'Chrome-Lighthouse';
        $crawlerList[] = 'Google Page Speed';
        $compiledRegex = $crawlerDetect->compileRegex($crawlerList);
        $compiledExclusions = $crawlerDetect->compileRegex($exclusions->getAll());

        $agent = trim(preg_replace(
            "/{$compiledExclusions}/i",
            '',
            invade($crawlerDetect)->userAgent ?: ''
        ));


        Blade::if('user', function () use ($agent, $compiledRegex) {
            return (bool) !preg_match("/{$compiledRegex}/i", $agent);
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-blade-crawler-detect');
    }
}
