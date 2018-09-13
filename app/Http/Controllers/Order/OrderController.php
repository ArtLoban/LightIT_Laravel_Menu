<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Order\StoreRequest;
use App\Services\CustomerOrderTransform\OrderTransform;
use App\Services\Repositories\CustomerRepository;
use App\Services\Repositories\DishRepository;
use App\Services\Repositories\OrderRepository;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        return $this->orderRepository = $orderRepository;
    }

    public function index(DishRepository $dishRepository, OrderTransform $orderTransform)
    {
        $selectedDishes = $orderTransform->getOrderedDishesFromSession();
        isset($selectedDishes) ? $dishes = $dishRepository->getByIds($selectedDishes) : $dishes = null;

        return view('menu.checkout', ['dishes' => $dishes]);
    }


    public function store(StoreRequest $request, CustomerRepository $customerRepository, DishRepository $dishRepository)
    {
        $requestData = $request->except('_token');
        $this->orderRepository->storeOrder($requestData, $customerRepository, $dishRepository);

        return view('menu.order_submited');
    }
}
