<?php

namespace App\Services\Repositories;

use App\Models\Order\DishOrder;

class DishOrderRepository extends Repository
{
    protected function getClassName()
    {
        return DishOrder::class;
    }
}