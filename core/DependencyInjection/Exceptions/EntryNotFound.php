<?php

namespace Core\DependencyInjection\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class EntryNotFound extends \RuntimeException implements NotFoundExceptionInterface
{
    private $failedEntry;

    public function __construct(string $failedEntry, $code = 0, Throwable $previous = null)
    {
        $this->failedEntry = $failedEntry;

        parent::__construct("Entry $failedEntry not found!", $code, $previous);
    }

    public function getFailedEntry(): string
    {
        return $this->failedEntry;
    }
}
