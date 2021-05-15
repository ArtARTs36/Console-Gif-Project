<?php

namespace Core\Exception\Contracts;

interface ExceptionHandler
{
    public function handle(\Throwable $exception);
}
