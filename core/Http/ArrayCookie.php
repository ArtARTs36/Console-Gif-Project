<?php

namespace Core\Http;

use Core\Http\Contracts\Cookie;

class ArrayCookie implements Cookie
{
    /** @var array<string, mixed> */
    protected $values = [];

    public function get(string $key)
    {
        return $this->values[$key] ?? null;
    }

    public function set(string $key, $value): ArrayCookie
    {
        $this->values[$key] = $value;

        return $this;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }
}
