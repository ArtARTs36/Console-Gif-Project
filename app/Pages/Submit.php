<?php

namespace App\Pages;

use App\Http\Requests\SubmitRequest;
use ArtARTs36\ConsoleGif\Console;

class Submit extends Page
{
    public function handle(SubmitRequest $request): string
    {
        return $this->viewer->render('submit', [
            'image' => '/anim/'. $this->createImage($request),
        ]);
    }

    private function createImage(SubmitRequest $request): string
    {
        $file = time() . '.gif';

        Console::bySize(...$request->getWidthAndHeight())
            ->addLines($request->getStrings())
            ->setUser($request->getUser())
            ->save(__DIR__ . '/../../var/anim/'. $file);

        return $file;
    }
}
