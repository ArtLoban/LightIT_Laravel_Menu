<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Cart\StoreRequest;
use App\Services\CustomerOrderTransform\OrderTransform;
use App\Services\Repositories\DishRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function index(DishRepository $dishRepository, OrderTransform $orderTransform)
    {
        $selectedDishes = $orderTransform->getOrderedDishesFromSession();
        $dishes = $dishRepository->getWithImageById($selectedDishes);

        return view('menu.cart', ['dishes' => $dishes]);
    }

    public function store(StoreRequest $request, OrderTransform $orderTransform)
    {
        $orderTransform->pushRequestIntoSession($request->only(['dishId', 'dishQuantity']));
    }
}
