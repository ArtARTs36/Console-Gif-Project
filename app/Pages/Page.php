<?php

namespace App\Pages;

use App\Support\Viewer;

abstract class Page
{
    protected $viewer;

    public function __construct(Viewer $viewer)
    {
        $this->viewer = $viewer;
    }
}
