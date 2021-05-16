<?php

namespace Core\Console\Contracts;

interface ConsoleCommand
{
    public static function getSignature(): string;

    public function execute(ConsoleOutput $output);
}
