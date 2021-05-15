<?php

namespace App\Exceptions;

use App\Support\Viewer;
use Core\Exception\Contracts\ExceptionHandler;

class AppExceptionHandler implements ExceptionHandler
{
    private $viewer;

    private $notifier;

    public function __construct(Viewer $viewer, ExceptionNotifier $notifier)
    {
        $this->viewer = $viewer;
        $this->notifier = $notifier;
    }

    public function handle(\Throwable $exception)
    {
        $this->notifier->notify($exception);
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
