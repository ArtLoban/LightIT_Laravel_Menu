<?php

namespace App\Services\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    protected function getClassName()
    {
        return Category::class;
    }

    public function create(array $params)
    {
        $params['image'] = $this->uploadImage($params['image']);

        return $this->className::create($params);
    }

    public function getImage(){

        if( $this->image == null ){

            return '/img/no_image.png';
        }

        return '/uploads/' . $this->image;
    }

}