<?php

namespace App\Http\Controllers;

use App\Contracts\ImageRepository;
use App\Http\Requests\SubmitRequest;
use App\Services\ImageService;
use Core\View\Contracts\Viewer;

class ImageController
{
    protected $images;

    protected $viewer;

    protected $service;

    public function __construct(ImageRepository $images, Viewer $viewer, ImageService $service)
    {
        $this->images = $images;
        $this->viewer = $viewer;
        $this->service = $service;
    }

    public function index(): string
    {
        return $this->viewer->render('index');
    }

    public function last(): string
    {
        return $this->viewer->render('last_images', [
            'images' => $this->images->getByLimit(9),
        ]);
    }

    public function store(SubmitRequest $request): string
    {
        return $this->viewer->render('submit', [
            'image' => '/anim/'. $this->service->create($request),
        ]);
    }
}
