<?php

namespace Core\Environment;

use Core\Environment\Contracts\EnvFetcher;
use Core\Environment\Contracts\Environment;

final class NullEnvFetcher implements EnvFetcher
{
    public function fetch(string $identity): Environment
    {
        return new NullEnvironment();
    }
}
