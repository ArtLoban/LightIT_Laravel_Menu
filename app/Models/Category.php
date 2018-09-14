<?php

namespace App\Models;

use App\Services\Image\Contracts\HasImage;
use App\Services\Repositories\Contracts\HasMorphRelations;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements HasImage, HasMorphRelations
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    /**
     * @return Image|mixed|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function ownerType(): string
    {
        return get_class($this);
    }

    /**
     * @return int
     */
    public function ownerId(): int
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getMorphRelations(): array
    {
        return [
            'image'
        ];
    }
}
