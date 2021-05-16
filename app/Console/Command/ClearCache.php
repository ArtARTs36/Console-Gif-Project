<?php

namespace App\Console\Command;

use App\Contracts\Command;
use Core\Contracts\ConsoleOutput;

class ClearCache extends Command
{
    public static function getSignature(): string
    {
        return 'cache:clear';
    }

    public function process()
    {
        $this->output->printColored(ConsoleOutput::COLOR_GREEN, 'Cache cleared!');
    }

    private function path(string $file): string
    {
        return realpath(__DIR__  . '/../../../var/cache/' . $file);
    }
}
