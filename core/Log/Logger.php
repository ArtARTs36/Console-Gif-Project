<?php

namespace Core\Log;

use Core\FileSystem\Contracts\FileSystem;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

final class Logger implements LoggerInterface
{
    use LoggerTrait;

    private $dir;

    private $files;

    public function __construct(string $dir, FileSystem $files)
    {
        $this->dir = $dir;
        $this->files = $files;
    }

    public function log($level, $message, array $context = [])
    {
        $log = compact('level', 'message', 'context');
        $json = json_encode($log);

        $this->files->append($this->buildPath(), $json);
    }

    private function buildPath(): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . date('Y-m-d') . '.log';
    }
}
