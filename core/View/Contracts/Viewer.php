<?php

namespace Core\View\Contracts;

interface Viewer
{
    public function render(string $template, array $attributes = []): string;
}
