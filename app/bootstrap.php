<?php

use App\Contracts\ImageRepository;
use App\Exceptions\AppExceptionHandler;
use App\Http\Routes\WebRoutes;
use App\Repositories\CacheImageRepository;
use App\Support\Cache;
use App\Support\Viewer;
use ArtARTs36\PushAllSender\Interfaces\PusherInterface;
use ArtARTs36\PushAllSender\Senders\PushAllSender;
use Core\DependencyInjection\Container;
use Core\Exception\Contracts\ExceptionHandler;
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
    ->bind(PushAllSender::class, function () {
        return new PushAllSender(1, 't');
    })
    ->contract(PusherInterface::class, PushAllSender::class)
    ->contract(ImageRepository::class, CacheImageRepository::class)
    ->contract(ExceptionHandler::class, AppExceptionHandler::class);
