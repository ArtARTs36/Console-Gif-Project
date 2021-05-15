<?php

use App\Http\Method;
use App\Http\Post;
use App\Support\Cache;
use App\Support\Viewer;

function method(string $class, $variables): Method
{
    static $container = [];

    if (empty($container[$class])) {
        $container[$class] = new $class($variables);
    }

    return $container[$class];
}

function post()
{
    return method(Post::class, $_POST ?? []);
}

function view(string $template, array $attributes = []): string
{
    return Viewer::render($template, $attributes);
}

function view_path(string $template): string
{
    return __DIR__ . '/../../views/' . $template . '.tpl';
}

function dd(...$vars)
{
    var_dump(...$vars);

    exit(0);
}
