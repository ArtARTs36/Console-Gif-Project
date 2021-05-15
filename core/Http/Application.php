<?php

namespace Core\Http;

use Core\DependencyInjection\Container;

class Application
{
    protected $router;

    protected $container;

    public function __construct(Router $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function run(Request $request)
    {
        $route = $this->router->findRoute($request);

        return $this->container->set(Request::class, $request)->callMethod(...$route->action());
    }
}
