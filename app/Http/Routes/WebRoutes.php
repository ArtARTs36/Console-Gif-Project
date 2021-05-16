<?php

namespace App\Http\Routes;

use Core\Http\Contracts\HasRoutes;
use Core\Http\Router;

class WebRoutes implements HasRoutes
{
    public function applyRoutes(Router $router): void
    {
        $router
            ->post('/submit', 'App\Pages\Submit::handle')
            ->get('/last', 'App\Pages\LastImages::handle')
            ->home('App\Pages\Index::handle');
    }
}
