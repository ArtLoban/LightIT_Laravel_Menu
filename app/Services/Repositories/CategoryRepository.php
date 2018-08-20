<?php

namespace App\Services\Repositories;

use App\Models\Category;
use App\Services\ImageUploader\ImageUpload;

class CategoryRepository extends Repository
{
    /**
     * Instance of App\Services\ImageUploader\ImageUpload
     * @var ImageUpload
     */
    private $imageUpload;

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
        return Category::class;
    }

}