<?php

namespace App\Pages;

use App\Contracts\Page;

class Index extends Page
{
    public function process(): string
    {
        return view('index');
    }
}
