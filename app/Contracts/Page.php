<?php

namespace App\Contracts;

abstract class Page
{
    abstract public function process(): string;

    public static function handle()
    {
        return new static();
    }

    public function __toString(): string
    {
        return $this->process();
    }
}
