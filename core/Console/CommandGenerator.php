<?php

namespace Core\Console;

use ArtARTs36\Str\Str;
use Core\FileSystem\Contracts\FileSystem;

class CommandGenerator
{
    protected $files;

    protected $dir;

    protected $appDir;

    public function __construct(
        FileSystem $files,
        string $dir = __DIR__ . '/stubs/',
        string $appDir = __DIR__ . '/../../app/Console/Command'
    ) {
        $this->files = $files;
        $this->dir = $dir;
        $this->appDir = $appDir;
    }

    public function generate(string $name, string $signature): void
    {
        $name = Str::make($name)->trim()->append('Command')->toStudlyCaps();

        $content = strtr($this->files->get($this->dir . '/command.php.stub'), [
            '{{ name }}' => $name,
            '{{ signature }}' => trim($signature),
            '{{ class }}' => $name,
        ]);

        $this->files->create($this->appDir . '/'. $name . '.php', $content);
    }
}
