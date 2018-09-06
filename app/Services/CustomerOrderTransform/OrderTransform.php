<?php

namespace App\Services\CustomerOrderTransform;


class OrderTransform
{
    /**
     * @param array $request
     */
    public function pushRequestIntoSession(array $request)
    {
        $id = $request['dishId'];
        session()->push("dishes.$id", $request['dishQuantity']);


//        session()->push('dishes', [
//            'dishId' => $request['dishId'],
//            'dishQuantity' => $request['dishQuantity']
//         ]);
    }

    /**
     * @return array|null
     */
    public function getOrderedDishesFromSession(): ?array
    {
        $dishes = session()->get('dishes');
        if ($dishes == null) {
            return null;
        }

        return $dishIds = array_keys($dishes);
    }

    /**
     * @param int $id
     */
    public function deleteItemFromOrder(int $id)
    {
        session()->forget("dishes.$id");
    }

}