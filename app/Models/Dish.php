<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['title'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients(){

        return $this->belongsToMany(
            Ingredient::class,
            'dishes_ingredients',
            'dish_id',
            'ingredient_id'
        );
    }
}
