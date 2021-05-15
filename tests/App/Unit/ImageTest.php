<?php

namespace Tests\App\Unit;

use App\Entities\Image;
use Tests\TestCase;

class ImageTest extends TestCase
{
    /**
     * @covers \App\Entities\Image::getPublicPath
     */
    public function testGetPublicPath(): void
    {
        $path = '/dir/dir/file.gif';
        $expected = '/anim/file.gif';

        $image = new Image($path);

        self::assertEquals($expected, $image->getPublicPath());
    }
}
