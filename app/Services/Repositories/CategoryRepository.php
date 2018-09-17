<?php

namespace App\Services\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName()
    {
        return Category::class;
    }

}