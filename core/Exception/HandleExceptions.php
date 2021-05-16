<?php

namespace Core\Exception;

use Core\Exception\Contracts\ExceptionHandler;
use Psr\Log\LoggerInterface;

class HandleExceptions
{
    private $handler;

    private $logger;

    public function __construct(ExceptionHandler $handler, LoggerInterface $logger)
    {
        $this->handler = $handler;
        $this->logger = $logger;
    }

    public function expected(\Closure $callback, string $point)
    {
        try {
            return $callback();
        } catch (\Throwable $exception) {
            $responseCode = $exception->getCode() !== 0 ? $exception->getCode() : 500;

            if ($responseCode === 500) {
                $this->logger->critical($exception->getTraceAsString(), [
                    'date' => date('Y-m-d H:i:s'),
                ]);
            }

            $this->handler->handle($exception);

            if ($point === 'web') {
                http_response_code($responseCode);

                return $this->handler->reportHtml($exception);
            } else {
                return $this->handler->reportConsole($exception);
            }
        }
    }
}
