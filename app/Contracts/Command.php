<?php

namespace App\Contracts;

abstract class Command
{
    protected const COLOR_BRIGHT_WHITE = '30';
    protected const COLOR_RED = '31';
    protected const COLOR_GREEN = '32';
    protected const COLOR_ORANGE = '33';
    protected const COLOR_BLUE = '34';
    protected const COLOR_VIOLETT = '35';
    protected const COLOR_BLAU = '36';
    protected const COLOR_GRAY = '37';

    abstract public static function getSignature(): string;

    abstract public function process();

    public function execute()
    {
        $this->process();
    }

    protected function printLn(string ...$texts): void
    {
        foreach ($texts as $text) {
            $this->print("{$text}\n");
        }
    }

    protected function colored(string $color, string $string): string
    {
        $coloredString = "";

        $coloredString .= "\033[" . $color . "m";

        $coloredString .= $string . "\033[0m";

        return $coloredString;
    }

    protected function printColored(string $color, string ...$strings): void
    {
        foreach ($strings as $str) {
            $this->print($this->colored($color, $str) . "\n");
        }
    }

    protected function ask(string $question, string $color = null)
    {
        if ($color) {
            $this->printColored($color, $question . "\n-> ");
        } else {
            $this->print($question . "\n-> ");
        }

        return fgets(STDIN);
    }

    protected function print(string $text): void
    {
        fwrite(STDERR, $text);
    }
}
