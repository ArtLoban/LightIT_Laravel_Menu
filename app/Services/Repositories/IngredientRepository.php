<?php

namespace App\Services\Repositories;

use App\Models\Ingredient;

class IngredientRepository extends Repository
{
    protected function getClassName()
    {
        return Ingredient::class;
    }

}