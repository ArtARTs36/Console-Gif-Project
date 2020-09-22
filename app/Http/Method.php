<?php

namespace App\Http;

abstract class Method
{
    protected $variables;

    public function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    public function has($key)
    {
        return isset($this->variables[$key]);
    }

    public function get($key, $default = null)
    {;
        return ! empty($this->variables[$key]) &&
            (! is_array($this->variables[$key]) ||
                is_array($this->variables[$key]) &&
                ! empty(end($this->variables[$key]))
            ) ?
            $this->variables[$key] :
            $default;
    }
}
