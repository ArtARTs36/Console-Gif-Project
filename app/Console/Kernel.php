<?php

namespace App\Console;

use Core\Contracts\ConsoleOutput;
use Core\Contracts\Container;
use Core\Exception\HandleExceptions;

class Kernel
{
    protected $commands = [];

    protected $container;

    protected $exceptions;

    protected $output;

    public function __construct(Container $container, HandleExceptions $exceptions, ConsoleOutput $output)
    {
        $this->container = $container;
        $this->exceptions = $exceptions;
        $this->output = $output;
    }

    public function add(string $commandClass): self
    {
        $this->commands[$commandClass::getSignature()] = $commandClass;

        return $this;
    }

    public function handle(array $argv)
    {
        return $this->exceptions->expected(function () use ($argv) {
            return $this->run($argv);
        }, 'console');
    }

    protected function run(array $argv): ?string
    {
        if (count($argv) < 2) {
            $this->output->error("Command Not Found");

            return null;
        }

        $signature = $argv[1];

        $command = $this->selectCommand($signature);

        if (null === $command) {
            $this->output->error("Command Not Found");

            return null;
        }

        return $this->container->make($command)->execute();
    }

    protected function selectCommand(string $signature): ?string
    {
        if (! array_key_exists($signature, $this->commands)) {
            return null;
        }

        return $this->commands[$signature];
    }
}
