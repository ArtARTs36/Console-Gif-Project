<?php

namespace App\Pages;

use App\Contracts\Page;
use App\Entities\Image;

class LastImages extends Page
{
    public function process(): string
    {
        return view('last_images', [
            'images' => Image::getByLimit(9),
        ]);
    }
}
