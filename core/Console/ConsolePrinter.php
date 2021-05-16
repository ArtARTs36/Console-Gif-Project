<?php

namespace Core\Console;

use Core\Console\Contracts\ConsoleOutput;

class ConsolePrinter implements ConsoleOutput
{
    public function ask(string $question, ?string $color = null): string
    {
        if ($color) {
            $this->printColored($color, $question . "\n-> ");
        } else {
            $this->print($question . "\n-> ");
        }

        return fgets(STDIN);
    }

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

    public function error(string $error): void
    {
        $this->printColored(ConsoleColor::COLOR_RED, 'Ошибка: '. $error);
    }

    protected function colored(string $color, string $string): string
    {
        $colored = "\033[" . $color . "m";

        return $colored . $string . "\033[0m";
    }
}
