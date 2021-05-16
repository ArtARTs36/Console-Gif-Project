<?php

namespace Core\DependencyInjection;

class ContainerBuilder
{
    protected $target;

    public function __construct(string $target = DiContainer::class)
    {
        $this->target = $target;
    }

    public function build(): \Core\DependencyInjection\Contracts\Container
    {
        $class = $this->target;
        /** @var \Core\DependencyInjection\Contracts\Container $container */
        $container = new $class();

        foreach (class_implements($this->target) as $interface) {
            $container->set($interface, $container);
        }

        return $container;
    }
}