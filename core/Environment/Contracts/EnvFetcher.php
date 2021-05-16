<?php

namespace Core\Environment\Contracts;

interface EnvFetcher
{
    public function fetch(string $identity): Environment;
}
