<?php

namespace Vlados\LaravelBladeCrawlerDetect;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vlados\LaravelBladeCrawlerDetect\Commands\LaravelBladeCrawlerDetectCommand;

class LaravelBladeCrawlerDetectServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-blade-crawler-detect')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-blade-crawler-detect_table')
            ->hasCommand(LaravelBladeCrawlerDetectCommand::class);
    }
}
