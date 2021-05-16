<?php

namespace App\Services;

use App\Http\Requests\SubmitRequest;
use ArtARTs36\ConsoleGif\Console;

class ImageService
{
    public function create(SubmitRequest $request): string
    {
        $file = time() . '.gif';

        Console::bySize(...$request->getWidthAndHeight())
            ->addLines($request->getStrings())
            ->setUser($request->getUser())
            ->save(__DIR__ . '/../../var/anim/'. $file);

        return $file;
    }
}
