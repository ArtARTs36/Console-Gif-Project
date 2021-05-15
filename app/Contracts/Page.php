<?php

namespace App\Contracts;

abstract class Page
{
    abstract public function handle(): string;

    public function __toString(): string
    {
        return $this->handle();
    }
}
