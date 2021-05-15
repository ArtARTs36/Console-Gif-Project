<?php

namespace Core\Contracts;

use Psr\Container\ContainerInterface;

interface Container extends ContainerInterface
{
    /**
     * @return static
     */
    public function set(string $class, object $object);

    /**
     * @return mixed
     */
    public function callMethod(string $class, string $method);

    /**
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function make(string $class);
}
