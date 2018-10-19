<?php

namespace App\Services\Repositories;

use App\Models\Order\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends Repository
{
    const IN_PROGRESS_STATUS = 1;
    const COMPLETED_STATUS = 2;
    const CANCELED_STATUS = 3;
    const NOT_FOUND_STATUS = 4;

    protected function getClassName(): string
    {
        return Order::class;
    }

    /**
     * Store customer's Order into related tables using transaction
     *
     * @param array $requestData
     * @param $customerRepository
     * @param $dishRepository
     */
    public function storeOrder(array $requestData, $currentUser, $dishRepository)
    {
        DB::transaction(function() use ($requestData, $currentUser, $dishRepository)
        {
            $currentUser->update([
                'name' => $requestData['name'],
                'phone_number' => $requestData['phone_number'],
            ]);

            $order = $this->className::create([
                'user_id' => $currentUser->getKey(),
                'delivery_id' => $requestData['delivery_id'],
                'status_id' => self::IN_PROGRESS_STATUS,
            ]);

            $this->storeOrderFromSession($order, $dishRepository);
        });
    }

    /**
     * Store Order items from session into DishOrders model
     *
     * @param $order
     * @param $dishRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeOrderFromSession($order, $dishRepository)
    {
        $dishes = session()->get('dishes');

        foreach ($dishes as $key => $value) {
            $order->dishOrders()->create([
                'dish_id' => $key,
                'dish_quantity' => array_sum($value),
                'price' => $this->findDishPriceById($key, $dishRepository)]);
        }

        return redirect()->route('checkout.index');
    }

    /**
     * Return price of the specific Dish
     *
     * @param $id
     * @param $dishRepository
     * @return string
     */
    private function findDishPriceById(int $id, $dishRepository): string
    {
        return $dishRepository->find($id)->price;
    }

    /**
     * Returns all Orders with related Customer, OrderDelivery, OrderStatus models
     *
     * @return mixed
     */
    public function getAllWithRelations()
    {
        return $this->className::with(['user', 'delivery', 'status'])->get();
    }

    /**
     * Returns a specific Order with nested relations
     *
     * @param $id
     * @return mixed
     */
    public function getWithRelation($id)
    {
        return $this->className::with('dishOrders.dish')->whereId($id)->first();
    }

    /**
     * Returns a Collection of Orders for specific User with nested relations
     *
     * @param $userId
     * @return mixed
     */
    public function getAllUserOrdersWithRelations(int $userId)
    {
        return $this->className::where('user_id', $userId)->with('dishOrders.dish', 'status')->get();
    }
}
