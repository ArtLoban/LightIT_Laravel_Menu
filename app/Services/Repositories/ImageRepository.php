<?php

namespace App\Services\Repositories;

use App\Models\Image;

class ImageRepository extends Repository
{
    protected function getClassName()
    {
        return Image::class;
    }

    public function attachUsersImages(int $roleName, array $image)
    {
        $this->className::find($roleName)->imageable()->attach($image);
    }

}