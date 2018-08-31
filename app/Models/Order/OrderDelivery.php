<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
