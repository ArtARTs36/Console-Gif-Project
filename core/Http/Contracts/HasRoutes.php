<?php

namespace Core\Http\Contracts;

use Core\Http\Router;

interface HasRoutes
{
    public function applyRoutes(Router $router): void;
}
