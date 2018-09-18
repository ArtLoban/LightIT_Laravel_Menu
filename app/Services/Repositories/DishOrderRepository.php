<?php

namespace App\Services\Repositories;

use App\Models\Order\DishOrder;
use Illuminate\Database\Eloquent\Collection;

class DishOrderRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName()
    {
        return DishOrder::class;
    }

    /**
     * Return Collection of DishOrders for a specific Dish
     *
     * @param int $dishId
     * @return Collection|null
     */
    public function getAllByDishIdWithDish(int $dishId): ?Collection
    {
       return $this->className::where('dish_id', $dishId)->with('dish')->get();
    }
}