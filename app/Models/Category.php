<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get all images of category
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
