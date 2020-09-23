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
        $files = scandir(__DIR__ . '/../../../var/cache');
        $files = array_diff($files, ['.', '..', '.gitignore']);

        foreach ($files as $file) {
            unlink($this->path($file));
        }
    }

    private function path(string $file): string
    {
        return realpath(__DIR__  . '/../../../var/cache/' . $file);
    }
}
