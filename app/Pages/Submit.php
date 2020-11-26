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

        Console::bySize(...$this->getWidthAndHeight())
            ->addLines($this->getStrings())
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

    private function getStrings(): array
    {
        $values = post()->get('strings', null);

        if (empty($values)) {
            $values[] = 'Hello, World! Hello, World! Hello, World!';
        }

        return $values;
    }

    private function getWidthAndHeight(): array
    {
        $default = 450;

        $prepare = function ($value) use ($default) {
            $intValue = (int) $value;

            return $intValue === 0 ? $default : $intValue;
        };

        return [
            $prepare(post()->get('width', 450)),
            $prepare(post()->get('height', 450)),
        ];
    }
}
