<?php

use App\Http\Method;
use App\Http\Post;
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
    return method(Post::class, $_POST);
}

function get()
{
    return method(\App\Http\Get::class, $_GET);
}

function uri(): ?string
{
    return $_SERVER['REQUEST_URI'] ?? null;
}

function is_current_uri(string $search): bool
{
    return strpos(uri(), $search) === 1;
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
