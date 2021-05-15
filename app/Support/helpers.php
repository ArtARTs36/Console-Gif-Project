<?php

function view_path(string $template): string
{
    return __DIR__ . '/../../views/' . $template . '.tpl';
}

function dd(...$vars)
{
    var_dump(...$vars);

    exit(0);
}
