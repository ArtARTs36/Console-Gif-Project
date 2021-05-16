<?php

namespace Tests;

use Core\Cache\Cache;
use Core\DependencyInjection\ContainerBuilder;
use Core\DependencyInjection\Contracts\Container;
use Core\Environment\Contracts\EnvFetcher;
use Core\Environment\NullEnvFetcher;
use Core\Environment\NullEnvironment;
use Core\Exception\Contracts\ExceptionHandler;
use core\Exception\NullExceptionHandler;
use Core\FileSystem\ArrayFileSystem;
use Core\FileSystem\Contracts\FileSystem;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var \Core\DependencyInjection\Contracts\Container */
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
            ->contract(FileSystem::class, ArrayFileSystem::class)
            ->bind(Cache::class, function (Container $container) {
                return new Cache('', $container->make(FileSystem::class));
            })
            ->contract(EnvFetcher::class, NullEnvFetcher::class)
            ->contract(ExceptionHandler::class, NullExceptionHandler::class);
    }

    protected function getClosedProperty(object $object, string $property)
    {
        $getter = function () use ($property) {
            return $this->$property;
        };

        return $getter->call($object);
    }
}
