<?php

use Core\DependencyInjection\Contracts\Container;
use Core\DependencyInjection\DiContainer;
use Core\Http\Application;
use Core\Http\Request;
use Core\Lang\Language;
use Core\Lang\LanguageSelector;

require_once 'server_ini.php';
require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::fromGlobal();

/** @var \Core\DependencyInjection\Contracts\Container $container */
$container = include __DIR__ . '/../app/bootstrap.php';

$container->bind(Language::class, function (Container $container) use ($request) {
    return $container->make(LanguageSelector::class)->select($request);
});

/** @var Application $app */
$app = $container->make(Application::class);
echo $app->run($request);
