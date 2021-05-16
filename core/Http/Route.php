<?php

namespace Core\Http;

class Route
{
    public $method;

    public $uri;

    protected $action;

    public function __construct(string $method, string $uri, string $action)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->action = $action;
    }

    /**
     * @return array<string>
     */
    public function action(): array
    {
        return explode('::', $this->action);
    }
}
