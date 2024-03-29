<?php

namespace App\Repositories;

use App\Contracts\ImageRepository;
use App\Entities\Image;
use Core\Cache\Contracts\CacheManager;

class CacheImageRepository implements ImageRepository
{
    protected $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return array<Image>
     */
    public function getByLimit(int $limit): array
    {
        $paths = $this->cache->remember('last_images', function () use ($limit) {
            return static::getPathsByLimit($limit);
        });

        return Image::wrap($paths);
    }

    public function getPathsByLimit(int $limit): array
    {
        $all = $this->getAllPaths();

        arsort($all);

        return array_slice($all, 0, $limit);
    }

    /**
     * @return array<string>
     */
    public function getAllPaths(): array
    {
        return glob(__DIR__ . '/../../var/anim/*.gif') ?? [];
    }
}
