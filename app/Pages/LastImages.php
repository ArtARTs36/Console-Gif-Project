<?php

namespace App\Pages;

use App\Contracts\ImageRepository;
use Core\View\Contracts\Viewer;

class LastImages extends Page
{
    protected $images;

    public function __construct(ImageRepository $images, Viewer $viewer)
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
