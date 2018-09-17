<?php

namespace App\Services\Repositories;

use App\Models\Ingredient;

class IngredientRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName()
    {
        return Ingredient::class;
    }

}