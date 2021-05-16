<?php

namespace core\Exception;

use Core\Exception\Contracts\ExceptionHandler;

final class NullExceptionHandler implements ExceptionHandler
{
    public function handle(\Throwable $exception)
    {
        throw $exception;
    }

    public function reportHtml(\Throwable $exception): string
    {
        return '';
    }

    public function reportConsole(\Throwable $exception): void
    {
        //
    }
}
