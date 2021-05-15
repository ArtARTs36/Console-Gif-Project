<?php

namespace App\Exceptions;

use App\Support\Viewer;
use Core\Exception\Contracts\ExceptionHandler;

class AppExceptionHandler implements ExceptionHandler
{
    private $viewer;

    public function __construct(Viewer $viewer)
    {
        $this->viewer = $viewer;
    }

    public function handle(\Throwable $exception)
    {
        // TODO: Implement handle() method.
    }

    public function reportHtml(\Throwable $exception): string
    {
        return $this->viewer->render('error', [
            'error' => $exception->getMessage(),
        ]);
    }

    public function reportConsole(\Throwable $exception): string
    {
        return $exception->getMessage();
    }
}
