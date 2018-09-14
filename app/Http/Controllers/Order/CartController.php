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

    /**
     * CartController constructor.
     * @param OrderTransform $orderTransform
     */
    public function __construct(OrderTransform $orderTransform)
    {
        $this->orderTransform = $orderTransform;
    }

    /**
     * @param DishRepository $dishRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DishRepository $dishRepository)
    {
        $selectedDishes = $this->orderTransform->getOrderedDishesFromSession();
        isset($selectedDishes) ? $dishes = $dishRepository->getWithImageById($selectedDishes) : $dishes = null;

        return view('menu.cart', ['dishes' => $dishes]);
    }

    /**
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $this->orderTransform->pushRequestIntoSession(
                $request->input('dishId'),
                $request->input('dishQuantity'
            ));
    }

    /**
     * Removes Dish id from Session
     *
     * @param $itemId
     */
    public function destroy($itemId)
    {
        $this->orderTransform->deleteItemFromOrder($itemId);
    }
}
