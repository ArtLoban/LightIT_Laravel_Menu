<?php

namespace App\Services\CustomerOrderTransform;

use App\Services\Repositories\DishRepository;

class OrderTransform
{
    const KEY = 'dishes';

    /**
     * @var DishRepository
     */
    private $dishRepository;

    public function __construct(DishRepository $dishRepository)
    {
        return $this->dishRepository = $dishRepository;
    }

    /**
     * @param int $dishId
     * @param int $dishQuantity
     */
    public function pushRequestIntoSession(int $dishId, int $dishQuantity)
    {
        session()->push("dishes.$dishId", $dishQuantity);
    }

    /**
     * Returns array of dish ids chosen by Customer and stored in session
     *
     * @return array|null
     */
    public function getOrderedDishesFromSession(): ?array
    {
        $dishes = session()->get('dishes');
        if ($dishes == null) {
            return null;
        }

        $this->countDishesTotalPrice($dishes);

        return $dishIds = array_keys($dishes);
    }

    /**
     * Counts and puts into session total price of all dishes chosen by customer
     *
     * @param array $dishes
     */
    public function countDishesTotalPrice(array $dishes)
    {
        $totalPrice = 0;

        foreach ($dishes as $key => $value) {
            $dishPrice = $this->dishRepository->find($key)->price;
            $quantity = array_sum($value);
            $totalPrice += ($dishPrice * $quantity);
        }

        session()->put('totalPrice', $totalPrice);
    }

    /**
     * Deletes dish id from session
     *
     * @param int $id
     */
    public function deleteItemFromOrder(int $id)
    {
        session()->forget("dishes.$id");
    }

}