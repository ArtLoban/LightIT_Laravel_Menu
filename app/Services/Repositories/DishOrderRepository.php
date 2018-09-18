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

    /**
     * Get set of data about 'name', 'quantity' and 'date' for a specific Dish
     *
     * @param $dishId
     * @return array|null
     */
    public function getDataByDishId($dishId): ?array
    {
        $collection = $this->className::where('dish_id', $dishId)->with('dish')->get();
        $data = $this->prepareData($collection);

        return $data;
    }

    /**
     * Transform necessary data from Collection of DishOrders into an array
     *
     * @param $collection
     * @return array|null
     */
    private function prepareData($collection): ?array
    {
        $result['name'] = $collection->first()->dish->name;
        $result['quantity'] = $collection->pluck('dish_quantity')->all();
        $result['date'] = $collection
            ->pluck('created_at')
            ->map(function ($item, $key) {
                return $item->format('d M Y');
            })
            ->all();

        return $result;
    }
}