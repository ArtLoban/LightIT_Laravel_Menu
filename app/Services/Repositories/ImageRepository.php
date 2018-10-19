<?php

namespace App\Services\Repositories;

use App\Models\Image;

class ImageRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Image::class;
    }

    /**
     *  For Roles Image seeding
     *
     * @param int $roleName
     * @param array $image
     */
    public function attachUsersImages(int $roleName, array $image)
    {
        $this->className::find($roleName)->imageable()->attach($image);
    }
}
