<?php

namespace Core\Http;

use Core\Http\Contracts\Cookie;

class GlobalCookie implements Cookie
{
    public function get(string $key)
    {
        return $_COOKIE[$key] ?? null;
    }

    public function set(string $key, $value): GlobalCookie
    {
        $_COOKIE[$key] = $value;

        return $this;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_COOKIE);
    }
}
