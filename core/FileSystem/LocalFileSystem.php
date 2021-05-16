<?php

namespace Core\FileSystem;

use Core\FileSystem\Contracts\FileSystem;

class LocalFileSystem implements FileSystem
{
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    public function create(string $path, string $content): bool
    {
        return file_put_contents($path, $content) !== false;
    }

    public function append(string $path, string $content): bool
    {
        return file_put_contents($path, $content, FILE_APPEND) !== false;
    }
}
