<?php

namespace Tests\Core;

use Core\Http\Router;
use Tests\TestCase;

class RouterTest extends TestCase
{
    /**
     * @covers \Core\Http\Router::get
     */
    public function testGet(): void
    {
        /** @var Router $router */
        $router = $this->appContainer->make(Router::class);

        $router->get('/home', 'TestAction');

        self::assertArrayHasKey('GET', $routes = $this->getRoutes($router));
        self::assertArrayHasKey('/home', $routes['GET']);
    }

    /**
     * @covers \Core\Http\Router::post
     */
    public function testPost(): void
    {
        /** @var Router $router */
        $router = $this->appContainer->make(Router::class);

        $router->post('/home', 'TestAction');

        self::assertArrayHasKey('POST', $routes = $this->getRoutes($router));
        self::assertArrayHasKey('/home', $routes['POST']);
    }

    protected function getRoutes(Router $router): array
    {
        return $this->getClosedProperty($router, 'routes');
    }
}
