<?php

namespace Core\Cache\Contracts;

interface CacheManager
{
    public function forgetAll(): void;

    public function remember(string $key, \Closure $callback, int $ttl = 3600 * 24);
}
