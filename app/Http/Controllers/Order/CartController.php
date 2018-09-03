<?php

namespace App\Http\Controllers\Order;

use App\Services\Repositories\DishRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function index(DishRepository $dishRepository)
    {
//        dd(session()->all());
//        $selectedDishes = session();
//        $dishes = $dishRepository->getWithImageById($selectedDishes);

//        return view('menu.cart', ['dishes' => $dishes]);
        return view('menu.cart');
    }

    public function store(Request $request)
    {
        dd($request);
        session(['dishes.id' => $request->get('dishId'),
                'dishes.quantity' => $request->get('dish-quantity')
            ]);

//        return redirect()->back();



//        dd($request->all(), session()->getId());
    }
}
