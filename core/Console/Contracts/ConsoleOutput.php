<?php

namespace Core\Console\Contracts;

interface ConsoleOutput
{
    public function printColored(string $color, string ...$strings): void;

    public function print(string $text): void;

    public function printLn(string ...$texts): void;

    public function error(string $error): void;
}
