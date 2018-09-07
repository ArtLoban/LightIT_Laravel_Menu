<?php

namespace App\Services\Repositories;

use App\Models\Order\DishOrder;

class DishOrderRepository extends Repository
{
    protected function getClassName()
    {
        return DishOrder::class;
    }

    public function storeOrderFromSession($request)
    {
        if ($request->submit == 'submited') {
            dd(session()->get('dishes'));
        }
    }

}