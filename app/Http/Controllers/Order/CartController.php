<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Cart\StoreRequest;
use App\Services\CustomerOrderTransform\OrderTransform;
use App\Services\Repositories\DishRepository;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @var OrderTransform
     */
    private $orderTransform;

    public function __construct(OrderTransform $orderTransform)
    {
        $this->orderTransform = $orderTransform;
    }


    public function index(DishRepository $dishRepository)
    {
//        dd(session()->all());

//        session()->forget('dishes.10');
//        session()->flush();

        $selectedDishes = $this->orderTransform->getOrderedDishesFromSession();
        isset($selectedDishes) ? $dishes = $dishRepository->getWithImageById($selectedDishes) : $dishes = null;

        return view('menu.cart', ['dishes' => $dishes]);
    }

    public function store(StoreRequest $request)
    {
        $this->orderTransform->pushRequestIntoSession($request->only(['dishId', 'dishQuantity']));
    }

    /**
     * Removes Dish id from Session
     *
     * @param $itemId
     */
    public function destroy($itemId)
    {
//        echo 'Ok!'. $itemId;
        $this->orderTransform->deleteItemFromOrder($itemId);
    }
}
