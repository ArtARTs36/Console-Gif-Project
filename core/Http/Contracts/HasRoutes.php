<?php

namespace Core\Http\Contracts;

interface HasRoutes
{
    public function applyRoutes(Router $router): void;
}
