<?php

use App\Http\Routes\WebRoutes;
use App\Support\Cache;
use Core\DependencyInjection\Container;
use Core\Http\Router;

Container::getInstance()
    ->bind(Cache::class, function () {
        return new Cache(__DIR__ . '/../var/cache');
    })
    ->after(Router::class, function (Router $router) {
        (new WebRoutes())->applyRoutes($router);
    })
    ->bind(\App\Support\Viewer::class, function () {
        return new \App\Support\Viewer(__DIR__ . '/../views');
    });
