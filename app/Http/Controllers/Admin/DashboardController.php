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
        $chart = $chartConstructor->getChart($dishOrder->getDataByDishId(13));

        return view('admin.dashboard', ['chart' => $chart]);
    }
}
