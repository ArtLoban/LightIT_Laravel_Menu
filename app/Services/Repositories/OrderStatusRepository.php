<?php

namespace App\Services\Repositories;

use App\Models\Order\OrderStatus;

class OrderStatusRepository extends Repository
{
    protected function getClassName()
    {
        return OrderStatus::class;
    }


}