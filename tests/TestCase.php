<?php

namespace Tests;

use Core\DependencyInjection\ContainerBuilder;
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
        $this->appContainer = (new ContainerBuilder())->build();

        $this
            ->appContainer
            ->contract(ExceptionHandler::class, NullExceptionHandler::class);
    }
}
