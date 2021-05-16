<?php

namespace Core\Http;

use Core\Http\Contracts\NotFoundException;
use Core\Http\Contracts\Router;
use Core\Http\Exceptions\RouteNotFound;

class ArrayRouter implements Router
{
    protected $routes = [];

    public function addRoute(string $method, string $uri, string $action): self
    {
        $this->routes[$method][$uri] = new Route($method, $uri, $action);

        return $this;
    }

    public function get(string $uri, string $action): self
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, string $action): self
    {
        return $this->addRoute('POST', $uri, $action);
    }

    /**
     * @throws NotFoundException
     */
    public function findRoute(Request $request): Route
    {
        $route = @$this->routes[$request->method()][$request->uri()];

        if (! $route) {
            throw new RouteNotFound($request);
        }

        return $route;
    }
}
