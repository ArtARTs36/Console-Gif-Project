<?php

namespace App\Contracts;

use Core\Console\Contracts\ConsoleOutput;

abstract class Command
{
    abstract public static function getSignature(): string;

    abstract public function process();

    protected $output;

    public function __construct(ConsoleOutput $output)
    {
        $this->output = $output;
    }

    public function execute()
    {
        $this->process();
    }

    protected function ask(string $question, string $color = null)
    {
        if ($color) {
            $this->output->printColored($color, $question . "\n-> ");
        } else {
            $this->output->print($question . "\n-> ");
        }

        return fgets(STDIN);
    }
}
