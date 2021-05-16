<?php

namespace Core\Cache;

use Core\Cache\Contracts\CacheManager;

class Cache implements CacheManager
{
    private $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function forgetAll(): void
    {
        if (! file_exists($this->dir)) {
            return;
        }

        $files = scandir($this->dir);
        $files = array_diff($files, ['.', '..', '.gitignore']);

        foreach ($files as $file) {
            unlink($this->path($file));
        }
    }

    public function get(string $key)
    {
        if (file_exists($path = $this->path($key))) {
            return json_decode(file_get_contents($path), true);
        }

        return null;
    }

    public function getByTtl(string $key, int $ttl)
    {
        $path = $this->path($key);

        if (! file_exists($path)) {
            return null;
        }

        $last = filemtime($path);

        if (time() - $last < $ttl) {
            return $this->get($key);
        }

        $this->forgetByPath($path);

        return null;
    }

    public function put(string $key, $data): self
    {
        return $this->putByPath($this->path($key), $data);
    }

    public function forget(string $key): self
    {
        return $this->forgetByPath($this->path($key));
    }

    public function remember(string $key, \Closure $callback, int $ttl = 3600 * 24)
    {
        $value = $this->getByTtl($key, $ttl);

        if (null !== $value) {
            return $value;
        }

        $this->put($key, $value = $callback());

        return $value;
    }

    private function putByPath(string $path, $data): self
    {
        file_put_contents($path, json_encode($data));

        return $this;
    }

    private function forgetByPath(string $path): self
    {
        unlink($path);

        return $this;
    }

    private function path(string $key): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . $key;
    }
}
