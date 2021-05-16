<?php

namespace App\Console\Command;

use App\Contracts\Command;
use Core\Cache\Contracts\CacheManager;
use Core\Console\ConsoleColor;
use Core\Console\Contracts\ConsoleOutput;

class ClearCache extends Command
{
    protected $cache;

    public function __construct(CacheManager $cache, ConsoleOutput $output)
    {
        parent::__construct($output);

        $this->cache = $cache;
    }

    public static function getSignature(): string
    {
        return 'cache:clear';
    }

    public function process()
    {
        $this->cache->forgetAll();

        $this->output->printColored(ConsoleColor::COLOR_GREEN, 'Cache cleared!');
    }
}
