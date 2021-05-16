<?php

namespace Core\Console;

use Core\Contracts\ConsoleOutput;

class ConsolePrinter implements ConsoleOutput
{
    public function printLn(string ...$texts): void
    {
        foreach ($texts as $text) {
            $this->print("{$text}\n");
        }
    }

    public function printColored(string $color, string ...$strings): void
    {
        foreach ($strings as $str) {
            $this->print($this->colored($color, $str) . "\n");
        }
    }

    public function print(string $text): void
    {
        fwrite(STDERR, $text);
    }

    protected function colored(string $color, string $string): string
    {
        $coloredString = "\033[" . $color . "m";

        $coloredString .= $string . "\033[0m";

        return $coloredString;
    }
}
