<?php

use App\Contracts\ImageRepository;
use App\Http\Routes\WebRoutes;
use App\Repositories\CacheImageRepository;
use App\Support\Cache;
use App\Support\Viewer;
use Core\DependencyInjection\Container;
use Core\Http\Router;

Container::getInstance()
    ->bind(Cache::class, function () {
        return new Cache(__DIR__ . '/../var/cache');
    })
    ->after(Router::class, function (Router $router) {
        (new WebRoutes())->applyRoutes($router);
    })
    ->bind(Viewer::class, function () {
        return new Viewer(__DIR__ . '/../views');
    })
    ->contract(ImageRepository::class, CacheImageRepository::class);
