<?php

namespace App\Exceptions;

use Core\Console\Contracts\ConsoleOutput;
use Core\Exception\Contracts\ExceptionHandler;
use Core\View\Contracts\Viewer;

class AppExceptionHandler implements ExceptionHandler
{
    private $viewer;

    private $notifier;

    private $console;

    public function __construct(Viewer $viewer, ExceptionNotifier $notifier, ConsoleOutput $console)
    {
        $this->viewer = $viewer;
        $this->notifier = $notifier;
        $this->console = $console;
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

    public function reportConsole(\Throwable $exception): void
    {
        $this->console->error($exception->getMessage());
    }
}
