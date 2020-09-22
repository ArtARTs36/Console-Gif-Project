<?php

use App\Http\Method;
use App\Http\Post;

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
    $template = file_get_contents(view_path($template));

    // Find included

    $matches = [];

    preg_match_all("/{{ include\('(.*)'\) }}/mi", $template, $matches);

    if (count($matches) === 2) {
        foreach ($matches[0] as $index => $code) {
            if (empty($matches[1][$index])) {
                continue;
            }

            $file = $matches[1][$index];

            $template = str_replace($code, view($file), $template);
        }
    }

    //

    $keys = array_map(function (string $attribute) {
        return "{{ $attribute }}";
    }, array_keys($attributes));

    return str_replace($keys, array_values($attributes), $template);
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
