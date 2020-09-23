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
     * @return static[]
     */
    public static function getAll(): array
    {
        return static::wrap(static::getAllPaths());
    }

    /**
     * @return string[]|null
     */
    public static function getAllPaths(): ?array
    {
        return glob(__DIR__ . '/../../var/anim/*.gif') ?? null;
    }

    public static function wrap(array $paths)
    {
        return array_map(function (string $path) {
            return new static($path);
        }, $paths);
    }

    /**
     * @param int $limit
     * @return static[]
     */
    public static function getByLimit(int $limit): array
    {
        return static::wrap(static::getPathsByLimit($limit));
    }

    public static function getPathsByLimit(int $limit): array
    {
        $all = static::getAllPaths();

        arsort($all);

        return array_slice($all, 0, $limit);
    }

    public static function getCacheByLimit(int $limit): array
    {
        $paths = cache('last_images', function () use ($limit) {
            return static::getPathsByLimit($limit);
        });

        return static::wrap($paths);
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
