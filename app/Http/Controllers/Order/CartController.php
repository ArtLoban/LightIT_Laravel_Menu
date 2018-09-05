<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Cart\StoreRequest;
use App\Services\CustomerOrderTransform\OrderTransform;
use App\Services\Repositories\DishRepository;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index(DishRepository $dishRepository, OrderTransform $orderTransform)
    {
        dd(session()->all());
//        session()->flush();

        $selectedDishes = $orderTransform->getOrderedDishesFromSession();
        isset($selectedDishes) ? $dishes = $dishRepository->getWithImageById($selectedDishes) : $dishes = null;

        return view('menu.cart', ['dishes' => $dishes]);
    }

    public function store(StoreRequest $request, OrderTransform $orderTransform)
    {
        $orderTransform->pushRequestIntoSession($request->only(['dishId', 'dishQuantity']));
    }

    public function destroy($id)
    {

    }
}
