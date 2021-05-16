<?php

namespace Core\Contracts;

interface ConsoleOutput
{
    public const COLOR_BRIGHT_WHITE = '30';
    public const COLOR_RED = '31';
    public const COLOR_GREEN = '32';
    public const COLOR_ORANGE = '33';
    public const COLOR_BLUE = '34';
    public const COLOR_VIOLETT = '35';
    public const COLOR_BLAU = '36';
    public const COLOR_GRAY = '37';
    
    public function printColored(string $color, string ...$strings): void;

    public function print(string $text): void;

    public function printLn(string ...$texts): void;
}
