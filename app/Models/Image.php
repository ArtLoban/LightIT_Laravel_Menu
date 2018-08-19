<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function entities()
    {
        return $this->belongsToMany(
            Image::class,
            'entity_image',
            'image_id',
            'entity_id'
        );
    }
}
