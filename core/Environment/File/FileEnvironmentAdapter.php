<?php

namespace Core\Environment\File;

use ArtARTs36\EnvEditor\Env;
use Core\Environment\Contracts\Environment;

class FileEnvironmentAdapter implements Environment
{
    private $env;

    public function __construct(Env $env)
    {
        $this->env = $env;
    }

    public function get(string $key, $default = null)
    {
        return $this->env->get($key) ?? $default;
    }

    /**
     * @return \ArrayIterator|iterable<string, bool|int|float|string>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->env->getVariables());
    }
}
