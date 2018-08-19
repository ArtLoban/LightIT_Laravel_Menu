<?php

namespace App\Services\Repositories;

use App\Models\Category;
use App\Services\UploadedFiles\ImageUpload;

class CategoryRepository extends Repository
{
    protected function getClassName()
    {
        return Category::class;
    }

    public function createWithImage($request)
    {
//        dd($this->className);
        self::images()->attach($request->file('image')->getClientOriginalName());

        return $this->className::create($request);
    }

}