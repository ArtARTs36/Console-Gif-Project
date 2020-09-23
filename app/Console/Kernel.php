<?php

namespace App\Console;

use App\Console\Command\ClearCache;
use App\Console\Command\PrintStat;
use App\Contracts\Command;

class Kernel
{
    protected $commands = [
        ClearCache::class,
        PrintStat::class,
    ];

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

        /** @var Command $command */
        $command = new $command();

        $command->execute();
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
