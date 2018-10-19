<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Charts\Contracts\ChartInterface;
use App\Services\Repositories\DishOrderRepository;

class DashboardController extends Controller
{
    /**
     * Show the Admin Panel dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ChartInterface $chartConstructor, DishOrderRepository $dishOrder)
    {
        $chart = $chartConstructor->getChart($dishOrder->getAllByDishIdWithDish(13));
        $dishOrders = $dishOrder->all()->unique('dish_id');

        return view('admin.dashboard', ['chart' => $chart, 'dishOrders' => $dishOrders]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        return redirect()->back();
    }
}
