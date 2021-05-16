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
            $responseCode = $exception->getCode() !== 0 ? $exception->getCode() : 500;

            http_response_code($responseCode);

            $this->handler->handle($exception);

            if ($point === 'web') {
                return $this->handler->reportHtml($exception);
            } else {
                return $this->handler->reportConsole($exception);
            }
        }
    }
}
