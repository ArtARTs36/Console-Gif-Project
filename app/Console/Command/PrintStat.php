<?php

namespace App\Console\Command;

use App\Contracts\Command;
use App\Contracts\ImageRepository;
use App\Entities\Image;
use Core\Contracts\ConsoleOutput;

class PrintStat extends Command
{
    protected $images;

    public function __construct(ImageRepository $images, ConsoleOutput $output)
    {
        $this->images = $images;

        parent::__construct($output);
    }

    public static function getSignature(): string
    {
        return 'stat:print';
    }

    public function process()
    {
        foreach ($this->images->getAllPaths() as $i => $file) {
            $time = pathinfo($file, PATHINFO_FILENAME);

            $this->output->printLn($i . '. ' . date('Y-m-d H:i:s', $time));
        }
    }
}
