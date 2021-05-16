<?php

namespace Core\Http;

use Core\DependencyInjection\Contracts\Container;
use Core\Exception\HandleExceptions;

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
        return $this->exceptions->expected(function () use ($request) {
            return $this->handleRoute($request);
        }, 'web');
    }

    protected function handleRoute(Request $request)
    {
        $route = $this->router->findRoute($request);

        return $this->container->set(Request::class, $request)->callMethod(...$route->action());
    }
}
