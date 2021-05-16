<?php

namespace Core\Console\Contracts;

interface ConsoleKernel
{
    /**
     * @return static
     */
    public function add(string $commandClass);

    /**
     * @return mixed
     */
    public function handle(array $argv);
}
