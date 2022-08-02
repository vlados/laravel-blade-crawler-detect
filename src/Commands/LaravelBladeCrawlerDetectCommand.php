<?php

namespace Vlados\LaravelBladeCrawlerDetect\Commands;

use Illuminate\Console\Command;

class LaravelBladeCrawlerDetectCommand extends Command
{
    public $signature = 'laravel-blade-crawler-detect';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
