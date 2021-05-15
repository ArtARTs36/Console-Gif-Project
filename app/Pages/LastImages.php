<?php

namespace App\Pages;

use App\Repositories\CacheImageRepository;
use App\Support\Viewer;

class LastImages extends Page
{
    protected $images;

    public function __construct(CacheImageRepository $images, Viewer $viewer)
    {
        $this->images = $images;

        parent::__construct($viewer);
    }

    public function handle(): string
    {
        return $this->viewer->render('last_images', [
            'images' => $this->images->getByLimit(9),
        ]);
    }
}
