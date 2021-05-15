<?php

namespace App\Console;

use Core\Contracts\Container;

class Kernel
{
    protected $commands = [];

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function add(string $commandClass): self
    {
        $this->commands[$commandClass::getSignature()] = $commandClass;

        return $this;
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

    protected function selectCommand(string $signature): ?string
    {
        if (! array_key_exists($signature, $this->commands)) {
            return null;
        }

        return $this->commands[$signature];
    }
}
