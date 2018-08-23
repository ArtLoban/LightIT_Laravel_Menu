<?php

namespace App\Services\Repositories;

use App\Models\Image;

class ImageRepository extends Repository
{
    protected function getClassName()
    {
        return Image::class;
    }

}