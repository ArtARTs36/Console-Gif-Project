<?php

namespace Core\Environment;

use Core\Environment\Contracts\Environment;

class NullEnvironment implements Environment
{
    public function get(string $key, $default = null)
    {
        return null;
    }

    public function getIterator()
    {
        return new \ArrayIterator([]);
    }
}
