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
            'dish_ingredient',
            'ingredient_id',
            'dish_id'
        );
    }

    /**
     * Get all images of ingredient
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

}
