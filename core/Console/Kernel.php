<?php

namespace Core\Console;

use Core\Console\Contracts\ConsoleKernel;
use Core\Console\Contracts\ConsoleOutput;
use Core\DependencyInjection\Contracts\Container;
use Core\Exception\HandleExceptions;

class Kernel implements ConsoleKernel
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
        $this->commands = [
            GeneratorCommand::getSignature() => GeneratorCommand::class,
        ];
    }

    public function add(string $commandClass): self
    {
        $this->commands[$commandClass::getSignature()] = $commandClass;

        return $this;
    }

    public function handle(array $argv)
    {
        return $this->exceptions->console(function () use ($argv) {
            return $this->run($argv);
        });
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

        return $this->container->callMethod($command, 'execute');
    }

    protected function selectCommand(string $signature): ?string
    {
        if (! array_key_exists($signature, $this->commands)) {
            return null;
        }

        return $this->commands[$signature];
    }
}
