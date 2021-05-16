<?php

use Core\DependencyInjection\DiContainer;
use Core\Http\Application;
use Core\Http\Request;

require_once 'server_ini.php';
require_once __DIR__ . '/../vendor/autoload.php';

/** @var \Core\Contracts\Container $container */
$container = include __DIR__ . '/../app/bootstrap.php';

/** @var Application $app */
$app = $container->make(Application::class);
echo $app->run(Request::fromGlobal());
