<?php

namespace App\Console\Command;

use Core\Cache\Contracts\CacheManager;
use Core\Console\ConsoleColor;
use Core\Console\Contracts\ConsoleCommand;
use Core\Console\Contracts\ConsoleOutput;

class ClearCache implements ConsoleCommand
{
    protected $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public static function getSignature(): string
    {
        return 'cache:clear';
    }

    public function execute(ConsoleOutput $output)
    {
        $this->cache->forgetAll();

        $output->printColored(ConsoleColor::COLOR_GREEN, 'Cache cleared!');
    }
}
