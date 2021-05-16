<?php

namespace App\Console\Command;

use App\Contracts\Command;
use App\Support\Cache;
use Core\Console\ConsoleColor;
use Core\Contracts\ConsoleOutput;

class ClearCache extends Command
{
    protected $cache;

    public function __construct(Cache $cache, ConsoleOutput $output)
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
