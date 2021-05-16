<?php

namespace Core\FileSystem;

use Core\FileSystem\Contracts\FileSystem;
use Core\FileSystem\Exceptions\FileNotFound;

class ArrayFileSystem implements FileSystem
{
    protected $files = [];

    public function exists(string $path): bool
    {
        return array_key_exists($path, $this->files);
    }

    public function create(string $path, string $content): bool
    {
        $this->setFile($path, $content);

        return true;
    }

    public function append(string $path, string $content): bool
    {
        if (array_key_exists($path, $this->files)) {
            $content = $this->files[$path] . $content;
        }

        $this->setFile($path, $content);

        return true;
    }

    public function delete(string $path): bool
    {
        unset($this->files[$path]);

        return true;
    }

    public function get(string $path): string
    {
        if (! $this->exists($path)) {
            throw new FileNotFound($path);
        }

        return $this->files[$path]['content'];
    }

    public function getUpdatedTime(string $path): int
    {
        return $this->files[$path]['time'];
    }

    private function setFile(string $path, string $content): void
    {
        $this->files[$path] = [
            'time' => time(),
            'content' => $content,
        ];
    }
}
