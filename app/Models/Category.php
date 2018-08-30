<?php

namespace App\Models;

use App\Services\Image\Contracts\HasImage;
use App\Services\Repositories\Contracts\HasMorphRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model implements HasImage, HasMorphRelations
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

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

    public function getImage()
    {
        return $this->image;
    }

    public function ownerType(): string
    {
        return get_class($this);
    }

    public function ownerId(): int
    {
        return $this->getKey();
    }

    public function getMorphRelations(): array
    {
        return [
            'image'
        ];
    }


}
