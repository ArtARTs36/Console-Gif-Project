<?php

namespace Tests\Core;

use Core\Http\ArrayRouter;
use Tests\TestCase;

class ArrayRouterTest extends TestCase
{
    /**
     * @covers \Core\Http\ArrayRouter::get
     */
    public function testGet(): void
    {
        /** @var ArrayRouter $router */
        $router = $this->appContainer->make(ArrayRouter::class);

        $router->get('/home', 'TestAction');

        self::assertArrayHasKey('GET', $routes = $this->getRoutes($router));
        self::assertArrayHasKey('/home', $routes['GET']);
    }

    /**
     * @covers \Core\Http\ArrayRouter::post
     */
    public function testPost(): void
    {
        /** @var ArrayRouter $router */
        $router = $this->appContainer->make(ArrayRouter::class);

        $router->post('/home', 'TestAction');

        self::assertArrayHasKey('POST', $routes = $this->getRoutes($router));
        self::assertArrayHasKey('/home', $routes['POST']);
    }

    protected function getRoutes(ArrayRouter $router): array
    {
        return $this->getClosedProperty($router, 'routes');
    }
}
