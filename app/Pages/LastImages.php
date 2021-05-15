<?php

namespace App\Pages;

use App\Repositories\CacheImageRepository;

class LastImages
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
