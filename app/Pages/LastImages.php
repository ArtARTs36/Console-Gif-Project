<?php

namespace App\Pages;

use App\Contracts\Page;
use App\Entities\Image;
use App\Repositories\CacheImageRepository;

class LastImages extends Page
{
    protected $images;

    public function __construct(CacheImageRepository $images)
    {
        $this->images = $images;
    }

    public function handle(): string
    {
        return view('last_images', [
            'images' => $this->images->getByLimit(9),
        ]);
    }
}
