<?php

namespace Core\Log;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Logger implements LoggerInterface
{
    use LoggerTrait;

    private $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function log($level, $message, array $context = [])
    {
        $log = compact('level', 'message', 'context');
        $json = json_encode($log);

        file_put_contents($this->buildPath(), $json, FILE_APPEND);
    }

    private function buildPath(): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . date('Y-m-d') . '.log';
    }
}
