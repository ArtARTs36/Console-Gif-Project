<?php

namespace Core\FileSystem\Contracts;

use Core\FileSystem\Exceptions\FileNotFound;

interface FileSystem
{
    public function exists(string $path): bool;

    public function create(string $path, string $content): bool;

    public function append(string $path, string $content): bool;

    public function delete(string $path): bool;

    /**
     * @throws FileNotFound
     */
    public function get(string $path): string;

    public function getUpdatedTime(string $path): int;
}
