<?php

namespace App\Services\Repositories;

use App\Models\Dish;

class DishRepository extends Repository
{
    protected function getClassName()
    {
        return Dish::class;
    }

    public function getDishesByCategoryId(int $categoryId)
    {
        return $this->className::with('image')->where(['category_id' => $categoryId])->get();
    }

}