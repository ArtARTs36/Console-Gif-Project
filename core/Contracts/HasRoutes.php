<?php

namespace Core\Contracts;

use Core\Http\Router;

interface HasRoutes
{
    public function applyRoutes(Router $router): void;
}
