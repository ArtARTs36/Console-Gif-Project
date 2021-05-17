<?php

namespace Core\Http\Contracts;

interface Cookie
{
    /**
     * @return mixed
     */
    public function get(string $key);

    /**
     * @return static
     */
    public function set(string $key, $value);

    public function has(string $key): bool;
}
