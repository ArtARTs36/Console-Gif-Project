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

    public function http(\Closure $callback)
    {
        try {
            return $callback();
        } catch (\Throwable $exception) {
            $responseCode = $exception->getCode() !== 0 ? $exception->getCode() : 500;

            if ($responseCode === 500) {
                $this->logger->error($exception->getTraceAsString(), [
                    'date' => date('Y-m-d H:i:s'),
                ]);
            }

            $this->handler->handle($exception);

            http_response_code($responseCode);

            return $this->handler->reportHtml($exception);
        }
    }

    public function console(\Closure $callback): void
    {
        try {
            $callback();
        } catch (\Throwable $exception) {
            $this->handler->handle($exception);
            $this->log($exception);
            $this->handler->reportConsole($exception);
        }
    }

    protected function log(\Throwable $exception): void
    {
        $this->logger->error($exception->getTraceAsString(), [
            'date' => date('Y-m-d H:i:s'),
        ]);
    }
}
