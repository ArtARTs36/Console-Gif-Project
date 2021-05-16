<?php

namespace Core\Environment\Contracts;

interface Environment extends \IteratorAggregate
{
    /**
     * @return mixed
     */
    public function get(string $key, $default = null);
}
