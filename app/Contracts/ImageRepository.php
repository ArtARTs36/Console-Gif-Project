<?php

namespace App\Contracts;

use App\Entities\Image;

interface ImageRepository
{
    /**
     * @return array<Image>
     */
    public function getByLimit(int $limit): array;

    /**
     * @return array<string>
     */
    public function getAllPaths(): array;
}
