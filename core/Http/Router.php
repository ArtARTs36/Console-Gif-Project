<?php

namespace Core\Http;

use Core\Http\Contracts\NotFoundException;
use Core\Http\Exceptions\RouteNotFound;

class Router
{
    protected $routes = [];

    /** @var Route|null */
    protected $homeRoute = null;

    public function get(string $uri, string $action): self
    {
        $this->routes['GET'][$uri] = new Route('GET', $uri, $action);

        return $this;
    }

    public function post(string $uri, string $action): self
    {
        $this->routes['POST'][$uri] = new Route('POST', $uri, $action);

        return $this;
    }

    public function home(string $action): self
    {
        $this->homeRoute = new Route('GET', '/', $action);

        return $this;
    }

    /**
     * @throws NotFoundException
     */
    public function findRoute(Request $request): Route
    {
        $route = @$this->routes[$request->method()][$request->uri()];

        if ($route) {
            return $route;
        }

        if ($this->homeRoute) {
            return $this->homeRoute;
        }

        throw new RouteNotFound($request);
    }
}
