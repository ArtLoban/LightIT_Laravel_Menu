<?php

namespace App\Services\Image\Contracts;

use App\Models\Image;

interface HasImage
{
    /**
     * @return Image|null
     */
    public function getImage();

    /**
     * @return string\
     */
    public function ownerType(): string;

    /**
     * @return int
     */
    public function ownerId(): int;
}