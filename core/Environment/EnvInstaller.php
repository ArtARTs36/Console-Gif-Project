<?php

namespace Core\Environment;

use Core\DependencyInjection\Contracts\Container;
use Core\Environment\Contracts\EnvFetcher;
use Core\Environment\Contracts\Environment;

class EnvInstaller
{
    public function fromContainer(Container $container, string $identity): void
    {
        $env = $container->make(EnvFetcher::class)->fetch($identity);

        $this->install($env);

        $container->set(Environment::class, $env);
    }

    public function install(Environment $environment): void
    {
        foreach ($environment as $variable => $value) {
            putenv("$variable=$value");
        }
    }
}
