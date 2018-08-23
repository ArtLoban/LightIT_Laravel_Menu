<?php

namespace App\Services\Repositories;

use App\Models\Dish;

class DishRepository extends Repository
{
    protected function getClassName()
    {
        return Dish::class;
    }

}