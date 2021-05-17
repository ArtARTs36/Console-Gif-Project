<?php

namespace Core\DependencyInjection;

use Core\DependencyInjection\Contracts\Container;

class ContainerBuilder
{
    protected $target;

    public function __construct(string $target = DiContainer::class)
    {
        $this->target = $target;
    }

    public function build(): Container
    {
        $class = $this->target;
        /** @var Container $container */
        $container = new $class();

        foreach (class_implements($this->target) as $interface) {
            $container->set($interface, $container);
        }

        return $container;
    }
}
