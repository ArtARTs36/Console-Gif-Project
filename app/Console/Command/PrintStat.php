<?php

namespace App\Console\Command;

use App\Contracts\Command;
use App\Entities\Image;

class PrintStat extends Command
{
    public static function getSignature(): string
    {
        return 'stat:print';
    }

    public function process()
    {
        $files = Image::getAllPaths();

        foreach ($files as $i => $file) {
            $time = pathinfo($file, PATHINFO_FILENAME);

            $this->printLn($i . '. ' . date('Y-m-d H:i:s', $time));
        }
    }
}
