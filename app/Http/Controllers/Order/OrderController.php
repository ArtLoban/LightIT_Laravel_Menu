<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Order\StoreRequest;
use App\Services\CustomerOrderTransform\OrderTransform;
use App\Services\Repositories\DishRepository;
use App\Services\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        return $this->orderRepository = $orderRepository;
    }

    /**
     * @param DishRepository $dishRepository
     * @param OrderTransform $orderTransform
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DishRepository $dishRepository, OrderTransform $orderTransform)
    {
        $selectedDishes = $orderTransform->getOrderedDishesFromSession();
        isset($selectedDishes) ? $dishes = $dishRepository->getByIds($selectedDishes) : $dishes = null;

        return view('menu.checkout', ['dishes' => $dishes]);
    }

    public function store(StoreRequest $request, DishRepository $dishRepository)
    {
        $requestData = $request->except('_token');
        $this->orderRepository->storeOrder($requestData, Auth::user(), $dishRepository);

        return view('menu.order_submited');
    }
}
