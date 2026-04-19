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
    private const MAX_USER_AGENT_LENGTH = 2048;

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
            $userAgent = request()?->userAgent() ?? '';

            // Clamp before any regex runs: the UA header is attacker-controlled
            // and unbounded input against complex crawler patterns risks ReDoS.
            $userAgent = substr((string) $userAgent, 0, self::MAX_USER_AGENT_LENGTH);

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
