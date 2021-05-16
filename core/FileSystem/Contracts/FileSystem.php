<?php

namespace Core\FileSystem\Contracts;

interface FileSystem
{
    public function exists(string $path): bool;

    public function create(string $path, string $content): bool;

    public function append(string $path, string $content): bool;
}
