<?php

namespace Core\View;

class RegexViewerDir
{
    private $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function __toString(): string
    {
        return $this->dir;
    }
}