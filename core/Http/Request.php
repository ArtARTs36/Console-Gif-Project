<?php

namespace Core\Http;

class Request
{
    protected $method;

    protected $uri;

    protected $variables;

    protected $locale;

    protected $cookies;

    public function __construct(string $method, string $uri, array $variables, string $locale, array $cookies)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->variables = $variables;
        $this->locale = $locale;
        $this->cookies = $cookies;
    }

    public static function fromGlobal(): self
    {
        return new static(
            $_SERVER['REQUEST_METHOD'] ?? 'GET',
            $_SERVER['REQUEST_URI'],
            array_merge($_GET ?? [], $_POST ?? []),
            $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'ru',
            $_COOKIE ?? []
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

    public function locale(): string
    {
        return $this->locale;
    }

    public function cookie(string $key)
    {
        return $this->cookies[$key] ?? null;
    }
}
