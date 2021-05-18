<?php

namespace Core\Console;

use Core\Console\Contracts\ConsoleCommand;
use Core\Console\Contracts\ConsoleOutput;

class GeneratorCommand implements ConsoleCommand
{
    private $generator;

    public function __construct(CommandGenerator $generator)
    {
        $this->generator = $generator;
    }

    public static function getSignature(): string
    {
        return 'core:command:generate';
    }

    public function execute(ConsoleOutput $output)
    {
        $name = $output->ask('Введите название команды');
        $signature = $output->ask('Введите сигнатуры команды');

        $this->generator->generate($name, $signature);
    }
}
