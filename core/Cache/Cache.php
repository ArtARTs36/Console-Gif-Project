<?php

namespace Core\Cache;

use Core\Cache\Contracts\CacheManager;
use Core\FileSystem\Contracts\FileSystem;

class Cache implements CacheManager
{
    private $dir;

    private $files;

    public function __construct(string $dir, FileSystem $files)
    {
        $this->dir = $dir;
        $this->files = $files;
    }

    public function forgetAll(): void
    {
        if (! $this->files->exists($this->dir)) {
            return;
        }

        $files = scandir($this->dir);
        $files = array_diff($files, ['.', '..', '.gitignore']);

        foreach ($files as $file) {
            $this->files->delete($file);
        }
    }

    public function get(string $key)
    {
        if ($this->files->exists($path = $this->path($key))) {
            return json_decode($this->files->get($path), true);
        }

        return null;
    }

    public function getByTtl(string $key, int $ttl)
    {
        $path = $this->path($key);

        if (! $this->files->exists($path)) {
            return null;
        }

        $last = $this->files->getUpdatedTime($path);

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
        $this->files->create($path, json_encode($data));

        return $this;
    }

    private function forgetByPath(string $path): self
    {
        $this->files->delete($path);

        return $this;
    }

    private function path(string $key): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . $key;
    }
}
