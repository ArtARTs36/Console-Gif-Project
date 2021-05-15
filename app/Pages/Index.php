<?php

namespace App\Pages;

use App\Contracts\Page;

class Index
{
    public function handle(): string
    {
        return view('index');
    }
}
