<?php

namespace Core\Exception\Contracts;

interface ExceptionHandler
{
    public function handle(\Throwable $exception);

    public function reportHtml(\Throwable $exception): string;

    public function reportConsole(\Throwable $exception): string;
}
