<?php

namespace Core\DependencyInjection;

use Core\DependencyInjection\Exceptions\DependencyResolutionFailed;
use Core\DependencyInjection\Exceptions\EntryNotFound;
use Psr\Container\ContainerInterface;

class DiContainer implements ContainerInterface, \Core\DependencyInjection\Contracts\Container
{
    /** @var array<string, object> */
    protected $resolvedInstances = [];

    /** @var array<string, callable>  */
    protected $binds = [];

    /** @var array<string, callable>  */
    protected $afterResolved = [];

    /** @var array<string, string> */
    protected $contracts = [];

    /**
     * @return object
     */
    public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new EntryNotFound($id);
        }

        return $this->resolvedInstances[$id];
    }

    public function make(string $class)
    {
        if (empty($class)) {
            throw new \InvalidArgumentException('Given empty string');
        }

        if (array_key_exists($class, $this->contracts)) {
            $class = $this->contracts[$class];
        }

        if ($this->has($class)) {
            return $this->resolvedInstances[$class];
        }

        if ($this->hasBind($class)) {
            return $this->resolved($this->makeFromBinds($class));
        }

        $reflector = new \ReflectionClass($class);

        if (! $reflector->hasMethod('__construct')) {
            return $this->resolved($reflector->newInstance());
        }

        $constructor = $reflector->getMethod('__construct');
        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            return $this->resolved($reflector->newInstance());
        }

        return $this->resolved($reflector->newInstance(...$this->resolveParameters($parameters)));
    }

    public function bind(string $abstract, \Closure $make): self
    {
        $this->binds[$abstract] = $make;

        return $this;
    }

    protected function makeFromBinds(string $abstract)
    {
        $make = $this->binds[$abstract];

        return $make($this);
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->resolvedInstances);
    }

    public function after(string $class, callable $after): self
    {
        $this->afterResolved[$class] = $after;

        return $this;
    }

    public function callMethod(string $class, string $method)
    {
        $parameters = (new \ReflectionClass($class))->getMethod($method)->getParameters();

        return $this->make($class)->$method(...$this->resolveParameters($parameters));
    }

    public function set(string $class, object $object): self
    {
        $this->resolvedInstances[$class] = $object;

        return $this;
    }

    public function contract(string $abstract, string $implementation): self
    {
        $this->contracts[$abstract] = $implementation;

        return $this;
    }

    protected function hasBind(string $abstract): bool
    {
        return array_key_exists($abstract, $this->binds);
    }

    protected function resolved(object $object): object
    {
        $class = get_class($object);

        if (array_key_exists($class, $this->afterResolved)) {
            $after = $this->afterResolved[$class];

            $after($object);
        }

        return $this->resolvedInstances[$class] = $object;
    }

    /**
     * @param array<\ReflectionParameter> $parameters
     * @throws DependencyResolutionFailed
     */
    protected function resolveParameters(array $parameters): array
    {
        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            $param = $parameter->getType()->__toString();

            if (interface_exists($param) || class_exists($param)) {
                if ($this->has($param)) {
                    $resolvedParameters[] = $this->get($param);
                } else {
                    $resolvedParameters[] = $this->make($param);
                }
            } elseif (! empty($parameter->isDefaultValueAvailable())) {
                $resolvedParameters[] = $parameter->getDefaultValue();
            } else {
                throw new DependencyResolutionFailed(
                    $parameter->getPosition(),
                    $param,
                    $parameter->getDeclaringClass()->getName()
                );
            }
        }

        return $resolvedParameters;
    }
}
