<?php

namespace App\Console;

use App\Console\Command\ClearCache;
use App\Console\Command\PrintStat;
use App\Contracts\Command;
use Core\Contracts\Container;

class Kernel
{
    protected $commands = [
        ClearCache::class,
        PrintStat::class,
    ];

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function handle()
    {
        $argc = $_SERVER['argc'] ?? 1;
        $argv = $_SERVER['argv'] ?? [];

        if ($argc === 1 || empty($argv) || count($argv) === 1) {
            echo "Command Not Found";

            return null;
        }

        $signature = $argv[1];

        $command = $this->selectCommand($signature);

        if (null === $command) {
            echo "Command Not Found";

            return null;
        }

        $this->container->make($command)->execute();
    }

    protected function selectCommand(string $signature)
    {
        foreach ($this->commands as $command) {
            if ($command::getSignature() === $signature) {
                return $command;
            }
        }

        return null;
    }
}
