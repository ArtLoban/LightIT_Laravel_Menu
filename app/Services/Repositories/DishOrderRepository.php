<?php

namespace App\Services\Repositories;

use App\Models\Order\DishOrder;

class DishOrderRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName()
    {
        return DishOrder::class;
    }
}