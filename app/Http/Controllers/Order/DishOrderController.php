<?php

namespace App\Http\Controllers\Order;

use App\Services\Repositories\DishOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DishOrderController extends Controller
{
    /**
     * @var DishOrderRepository
     */
    private $dishOrderRepository;

    /**
     * DishOrderController constructor.
     * @param DishOrderRepository $dishOrderRepository
     */
    public function __construct(DishOrderRepository $dishOrderRepository)
    {
        $this->dishOrderRepository = $dishOrderRepository;
    }

    public function index()
    {
        return view('menu.checkout', ['orderItems' => $this->dishOrderRepository->all()]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->dishOrderRepository->storeOrderFromSession($request);
        return redirect()->route('checkout.index');
    }
}
