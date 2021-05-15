<?php

namespace App\Pages;

use App\Contracts\Page;

class Index extends Page
{
    public function handle(): string
    {
        return view('index');
    }
}
