<?php

namespace App\Http\Controllers\Order;

use App\Services\Repositories\DishRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function index(DishRepository $dishRepository)
    {
//        dd(session()->all(), auth()->user());

        $selectedDishes = session()->get('dishes');
        dd($selectedDishes);
//        $dishes = $dishRepository->getWithImageById($selectedDishes);

//        return view('menu.cart', ['dishes' => $dishes]);
        return view('menu.cart');
    }

    public function store(Request $request)
    {
        session()->push('dishes', ['dishId' => $request->get('dishId'),
                                    'dishQuantity' => $request->get('dishQuantity')
                                ]);
    }
}
