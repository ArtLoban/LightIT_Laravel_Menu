<?php

namespace App\Models;

use App\Models\Order\DishOrder;
use App\Services\Image\Contracts\HasImage;
use App\Services\Repositories\Contracts\HasMorphRelations;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model implements HasImage, HasMorphRelations
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'weight',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients(){

        return $this->belongsToMany(
            Ingredient::class,
            'dish_ingredient',
            'dish_id',
            'ingredient_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishOrders()
    {
        return $this->hasMany(DishOrder::class);
    }

    /**
     * Get all images of Dish
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
