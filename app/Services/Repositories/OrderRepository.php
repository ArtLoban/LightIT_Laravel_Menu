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

    protected function getClassName()
    {
        return Order::class;
    }

    public function storeOrder(array $requestData, $customerRepository, $dishRepository)
    {
        DB::transaction(function() use ($requestData, $customerRepository, $dishRepository) {

            $customer = $customerRepository->create([
                'name' => $requestData['name'],
                'phone_number' => $requestData['phone_number'],
                'session_id' => session()->getId(),
            ]);

            $order = $this->className::create([
                'customer_id' => $customer->id,
                'delivery_id' => $requestData['delivery_id'],
                'status_id' => self::IN_PROGRESS_STATUS,
            ]);

            $this->storeOrderFromSession($order, $dishRepository);
        });
    }

    /**
     * Stores order items from session into DishOrders model
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
     * @param $id
     * @param $dishRepository
     * @return string
     */
    private function findDishPriceById($id, $dishRepository): string
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
        return $this->className::with(['customer', 'delivery', 'status'])->get();
    }
}