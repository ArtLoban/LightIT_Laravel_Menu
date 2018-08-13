<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name'];

    public function dishes()
    {
        return $this->belongsToMany(
            Dish::class,
            'dishes_ingredients',
            'ingredient_id',
            'dish_id'
        );
    }

}
