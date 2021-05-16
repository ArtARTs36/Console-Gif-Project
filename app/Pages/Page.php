<?php

namespace App\Pages;

use Core\View\Contracts\Viewer;

abstract class Page
{
    protected $viewer;

    public function __construct(Viewer $viewer)
    {
        $this->viewer = $viewer;
    }
}
