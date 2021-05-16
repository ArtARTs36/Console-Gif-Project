<?php

namespace Core\Http;

use Core\DependencyInjection\Contracts\Container;
use Core\Exception\HandleExceptions;
use Core\Http\Contracts\Router;

class Application
{
    protected $router;

    protected $container;

    protected $exceptions;

    public function __construct(Router $router, Container $container, HandleExceptions $exceptions)
    {
        $this->router = $router;
        $this->container = $container;
        $this->exceptions = $exceptions;
    }

    public function run(Request $request)
    {
        return $this->exceptions->http(function () use ($request) {
            return $this->handleRoute($request);
        });
    }

    protected function handleRoute(Request $request)
    {
        $route = $this->router->findRoute($request);

        return $this->container->set(Request::class, $request)->callMethod(...$route->action());
    }
}
