<?php

namespace App\Pages;

use App\Contracts\Page;
use ArtARTs36\ConsoleGif\Console;

class Submit extends Page
{
    public function process(): string
    {
        return view('submit', [
            'image' => '/anim/'. $this->createImage(),
        ]);
    }

    private function createImage(): string
    {
        $file = time() . '.gif';

        Console::bySize((int) post()->get('width', 450), (int) post()->get('height', 450))
            ->addLines(post()->get('strings', [' ']))
            ->setUser($this->user())
            ->save(__DIR__ . '/../../var/anim/'. $file);

        return $file;
    }

    private function user(): string
    {
        $user = post()->get('user');

        if (empty($user)) {
            return '';
        }

        return trim($user) . ' ';
    }
}
