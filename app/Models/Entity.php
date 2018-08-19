<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'entity_image',
            'entity_id',
            'image_id'
        );
    }
}
