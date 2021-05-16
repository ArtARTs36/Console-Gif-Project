<?php

namespace Core\Http;

class Request
{
    protected $method;

    protected $uri;

    protected $variables;

    public function __construct(string $method, string $uri, array $variables)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->variables = $variables;
    }

    public static function fromGlobal(): self
    {
        return new static(
            $_SERVER['REQUEST_METHOD'] ?? 'GET',
            $_SERVER['REQUEST_URI'],
            array_merge($_GET ?? [], $_POST ?? [])
        );
    }

    public function has($key): bool
    {
        return isset($this->variables[$key]);
    }

    public function get($key, $default = null)
    {
        return ! empty($this->variables[$key]) &&
        (! is_array($this->variables[$key]) ||
            is_array($this->variables[$key]) &&
            ! empty(array_filter($this->variables[$key]))
        ) ?
            $this->variables[$key] :
            $default;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function method(): string
    {
        return $this->method;
    }
}
