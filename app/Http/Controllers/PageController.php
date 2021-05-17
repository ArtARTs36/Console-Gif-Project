<?php

namespace App\Http\Controllers;

use Core\View\Contracts\Viewer;

class PageController
{
    private $viewer;

    public function __construct(Viewer $viewer)
    {
        $this->viewer = $viewer;
    }

    public function about(): string
    {
        return $this->viewer->render('page_about');
    }
}
