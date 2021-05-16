<?php

namespace Core\Http\Contracts;

use Core\Http\Request;
use Core\Http\Route;

interface Router
{
    /**
     * @return static
     */
    public function addRoute(string $method, string $uri, string $action);

    /**
     * @return static
     */
    public function get(string $uri, string $action);

    /**
     * @return static
     */
    public function post(string $uri, string $action);

    /**
     * @throws NotFoundException
     */
    public function findRoute(Request $request): Route;
}
