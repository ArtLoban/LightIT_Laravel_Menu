<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'weight',
        'image',
        'ingredient_id'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients(){

        return $this->belongsToMany(
            Ingredient::class,
            'dish_ingredient',
            'dish_id',
            'ingredient_id'
        );
    }
}
