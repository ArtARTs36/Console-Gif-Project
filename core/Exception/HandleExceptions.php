<?php

namespace Core\Exception;

use Core\Exception\Contracts\ExceptionHandler;

class HandleExceptions
{
    private $handler;

    public function __construct(ExceptionHandler $handler)
    {
        $this->handler = $handler;
    }

    public function expected(\Closure $callback)
    {
        try {
            return $callback();
        } catch (\Throwable $exception) {
            $this->handler->handle($exception);

            return null;
        }
    }
}
