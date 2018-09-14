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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
