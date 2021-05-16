<?php

namespace App\Entities;

class Image
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param array<string> $paths
     */
    public static function wrap(array $paths): array
    {
        return array_map(function (string $path) {
            return new static($path);
        }, $paths);
    }

    public function getPublicPath(): string
    {
        $file = pathinfo($this->path, PATHINFO_BASENAME);

        return '/anim/'. $file;
    }

    public function __toString(): string
    {
        return $this->getPublicPath();
    }
}
