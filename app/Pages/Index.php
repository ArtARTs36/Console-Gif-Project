<?php

namespace App\Pages;

class Index extends Page
{
    public function handle(): string
    {
        return $this->viewer->render('index');
    }
}
