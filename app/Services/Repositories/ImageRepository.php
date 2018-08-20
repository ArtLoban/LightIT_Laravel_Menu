<?php

namespace App\Services\Repositories;

use App\Models\Image;
use App\Services\ImageUploader\ImageUpload;

class ImageRepository extends Repository
{
    /**
     * Instance of App\Services\ImageUploader\ImageUpload
     * @var ImageUpload
     */
    protected $imageUpload;

    /**
     * UserRepository constructor.
     * @param ImageUpload $imageUpload
     */
    public function __construct(ImageUpload $imageUpload)
    {
        parent::__construct();
        $this->imageUpload = $imageUpload;
    }

    protected function getClassName()
    {
        return Image::class;
    }

}