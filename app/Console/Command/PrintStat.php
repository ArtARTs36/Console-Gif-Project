<?php

namespace App\Console\Command;

use App\Contracts\ImageRepository;
use Core\Console\Contracts\ConsoleCommand;
use Core\Console\Contracts\ConsoleOutput;

class PrintStat implements ConsoleCommand
{
    protected $images;

    public function __construct(ImageRepository $images)
    {
        $this->images = $images;
    }

    public static function getSignature(): string
    {
        return 'stat:print';
    }

    public function execute(ConsoleOutput $output)
    {
        foreach ($this->images->getAllPaths() as $i => $file) {
            $time = pathinfo($file, PATHINFO_FILENAME);

            $output->printLn($i . '. ' . date('Y-m-d H:i:s', $time));
        }
    }
}
