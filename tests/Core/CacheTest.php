<?php

namespace Tests\Core;

use Core\Cache\Cache;
use Core\FileSystem\Contracts\FileSystem;
use Tests\TestCase;

class CacheTest extends TestCase
{
    /**
     * @covers \Core\Cache\Cache::get
     */
    public function testGet(): void
    {
        /** @var FileSystem $files */
        $files = $this->appContainer->make(FileSystem::class);

        /** @var Cache $cache */
        $cache = $this->appContainer->make(Cache::class);

        // Хранилище пустое

        self::assertNull($cache->get('test'));

        // Добавили файл

        $files->create('/test', json_encode(['test']));

        self::assertEquals(['test'], $cache->get('test'));
    }
}
