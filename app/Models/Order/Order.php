<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'delivery_id', 'status_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->belongsTo(OrderDelivery::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function dishOrders()
    {
        return $this->hasMany(DishOrder::class);
    }
}
