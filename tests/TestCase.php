<?php

namespace Tests;

use Core\DependencyInjection\Container;
use Core\Exception\Contracts\ExceptionHandler;
use core\Exception\NullExceptionHandler;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var \Core\Contracts\Container */
    protected $appContainer;

    protected function setUp()
    {
        parent::setUp();

        $this->install();
    }

    protected function install(): void
    {
        $this
            ->appContainer
            ->contract(ExceptionHandler::class, NullExceptionHandler::class);
    }
}