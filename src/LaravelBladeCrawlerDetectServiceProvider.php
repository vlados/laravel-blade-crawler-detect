<?php

namespace Vlados\LaravelBladeCrawlerDetect;

use Illuminate\Support\Facades\Blade;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Jaybizzle\CrawlerDetect\Fixtures\Crawlers;
use Jaybizzle\CrawlerDetect\Fixtures\Exclusions;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBladeCrawlerDetectServiceProvider extends PackageServiceProvider
{
    public function packageRegistered()
    {
        $this->app->singleton(CrawlerDetect::class, fn () => new CrawlerDetect());
        $this->app->alias(CrawlerDetect::class, 'CrawlerDetect');
    }

    public function packageBooted()
    {
        $crawlerDetect = $this->app->make(CrawlerDetect::class);

        $crawlerList = (new Crawlers())->getAll();
        $crawlerList[] = 'Chrome-Lighthouse';
        $crawlerList[] = 'Google Page Speed';

        $compiledRegex = $crawlerDetect->compileRegex($crawlerList);
        $compiledExclusions = $crawlerDetect->compileRegex((new Exclusions())->getAll());

        Blade::if('user', function () use ($compiledRegex, $compiledExclusions) {
            $userAgent = request()?->userAgent() ?? $_SERVER['HTTP_USER_AGENT'] ?? '';

            $agent = trim((string) preg_replace(
                "/{$compiledExclusions}/i",
                '',
                $userAgent
            ));

            return $agent === '' || ! preg_match("/{$compiledRegex}/i", $agent);
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('laravel-blade-crawler-detect');
    }
}
