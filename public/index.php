<?php

use Core\DependencyInjection\Container;
use Core\Http\Application;
use Core\Http\Request;

require_once 'server_ini.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .'/../app/bootstrap.php';

/** @var Application $app */
$app = Container::getInstance()->make(Application::class);
echo $app->run(Request::fromGlobal());