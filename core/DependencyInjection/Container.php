<?php

namespace Core\DependencyInjection;

class Container
{
    protected static $selfInstance = null;

    protected $resolvedInstances = [];

    /** @var array<string, callable>  */
    protected $binds = [];

    /** @var array<string, callable>  */
    protected $afterResolved = [];

    public static function getInstance(): self
    {
        if (static::$selfInstance === null) {
            $instance = new static();
            $instance->resolvedInstances[static::class] = $instance;
            static::$selfInstance = $instance;
        }

        return static::$selfInstance;
    }

    /**
     * @return object
     */
    public function get($id)
    {
        return $this->resolvedInstances[$id];
    }

    public function make(string $class)
    {
        if (empty($class)) {
            throw new \LogicException();
        }

        if (array_key_exists($class, $this->resolvedInstances)) {
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

        if (empty($parameters)) {
            return $this->resolved($reflector->newInstance());
        }

        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            $param = $parameter->getType()->__toString();

            if (class_exists($param)) {
                if ($this->has($param)) {
                    $resolvedParameters[] = $this->get($param);
                } else {
                    $resolvedParameters[] = $this->make($param);
                }
            } elseif (! empty($parameter->isDefaultValueAvailable())) {
                $resolvedParameters[] = $parameter->getDefaultValue();
            } else {
                throw new \LogicException(
                    'Невозможно внедрить параметр: [' . $parameter->getPosition() . ']' . $param . ' в '. $class
                );
            }
        }

        return $this->resolved($reflector->newInstance(...$resolvedParameters));
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

    public function has($id)
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
        return $this->make($class)->$method();
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
}
