<?php

namespace App\Models\Order;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Model;

class DishOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'dish_id',
        'dish_quantity',
        'price',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
