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

    public function expected(\Closure $callback, string $point)
    {
        try {
            return $callback();
        } catch (\Throwable $exception) {
            $this->handler->handle($exception);

            if ($point === 'web') {
                return $this->handler->reportHtml($exception);
            } else {
                return $this->handler->reportConsole($exception);
            }
        }
    }
}
