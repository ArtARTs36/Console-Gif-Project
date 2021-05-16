<?php

namespace Core\FileSystem\Exceptions;

use Throwable;

class FileNotFound extends \Exception
{
    public function __construct(string $path, $code = 0, Throwable $previous = null)
    {
        $message = "File by path $path not found";

        parent::__construct($message, $code, $previous);
    }
}
