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

    /**
     * @param int $id
     * @param array $array
     * @return mixed
     */
    public function attachIngredients(int $id, array $array)
    {
        return $this->className::find($id)->ingredients()->attach($array);

    }

}