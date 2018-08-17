<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'entities_images',
            'entity_id',
            'image_id'
        );
    }
}
