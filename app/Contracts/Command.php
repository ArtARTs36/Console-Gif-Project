<?php

namespace App\Contracts;

abstract class Command
{
    abstract public static function getSignature(): string;

    abstract public function process();

    public function execute()
    {
        $this->process();
    }
}
