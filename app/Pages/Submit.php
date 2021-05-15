<?php

namespace App\Pages;

use App\Contracts\Page;
use App\Http\Requests\SubmitRequest;
use ArtARTs36\ConsoleGif\Console;

class Submit extends Page
{
    protected $request;

    public function __construct(SubmitRequest $request)
    {
        $this->request = $request;
    }

    public function handle(): string
    {
        return view('submit', [
            'image' => '/anim/'. $this->createImage(),
        ]);
    }

    private function createImage(): string
    {
        $file = time() . '.gif';

        Console::bySize(...$this->request->getWidthAndHeight())
            ->addLines($this->request->getStrings())
            ->setUser($this->request->getUser())
            ->save(__DIR__ . '/../../var/anim/'. $file);

        return $file;
    }
}
