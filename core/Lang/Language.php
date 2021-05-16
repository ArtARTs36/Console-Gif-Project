<?php

namespace Core\Lang;

class Language
{
    protected $lang;

    /** @var array<string, string> */
    protected $sentences;

    public function __construct(string $lang, array $sentences)
    {
        $this->lang = $lang;
        $this->sentences = $sentences;
    }

    public function get(string $key)
    {
        return $this->sentences[$key] ?? [];
    }

    public function all(): array
    {
        return $this->sentences;
    }
}
