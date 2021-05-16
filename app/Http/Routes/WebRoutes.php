<?php

namespace App\Http\Routes;

use Core\Http\Contracts\HasRoutes;
use Core\Http\Router;

class WebRoutes implements HasRoutes
{
    public function applyRoutes(Router $router): void
    {
        $router
            ->post('/submit', 'App\Http\Controllers\ImageController::store')
            ->get('/last', 'App\Http\Controllers\ImageController::last')
            ->home('App\Http\Controllers\ImageController::index');
    }
}
