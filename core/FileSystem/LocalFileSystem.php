<?php

namespace Core\FileSystem;

use Core\FileSystem\Contracts\FileSystem;
use Core\FileSystem\Exceptions\FileNotFound;

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

    public function delete(string $path): bool
    {
        return @unlink($path);
    }

    public function get(string $path): string
    {
        if (! $this->exists($path)) {
            throw new FileNotFound($path);
        }

        return file_get_contents($path);
    }

    public function getUpdatedTime(string $path): int
    {
        return filemtime($path);
    }
}
