<?php

namespace Core\FileSystem;

use Core\FileSystem\Contracts\FileSystem;

class ArrayFileSystem implements FileSystem
{
    protected $files = [];

    public function exists(string $path): bool
    {
        return array_key_exists($path, $this->files);
    }

    public function create(string $path, string $content): bool
    {
        $this->files[$path] = $content;

        return true;
    }

    public function append(string $path, string $content): bool
    {
        $this->files[$path] .= $content;

        return true;
    }
}
