<?php

namespace App\Console\Command;

use App\Contracts\Command;

class ClearCache extends Command
{
    public static function getSignature(): string
    {
        return 'cache:clear';
    }

    public function process()
    {
        $this->printColored(static::COLOR_GREEN, 'Cache cleared!');
    }

    private function path(string $file): string
    {
        return realpath(__DIR__  . '/../../../var/cache/' . $file);
    }
}
