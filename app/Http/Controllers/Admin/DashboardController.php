<?php

namespace App\Http\Controllers\Admin;

use App\Charts\DishSales;
use App\Charts\Sales;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the Admin Panel dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $chart = new DishSales();

//        $chart->labels(['One', 'Two', 'Three', 'Four']);
//        $chart->dataset('My dataset', 'line', [4, 1, 2, 4]);
//        $chart->dataset('My dataset 2', 'line', [4, 4, 3, 2]);
//        $chart->height(300);

//        $chart->dataset('Sample', 'line', [100, 65, 84, 45, 90]);

        $chart->labels(['One', 'Two', 'Three', 'Four', 'Five'])->options(['legend' => ['display' => false]]);
        $chart->dataset('Sample', 'line', [100, 65, 84, 45, 90])->options(['borderColor' => '#ff0000']);
        $chart->height(300);

        return view('admin.dashboard', ['chart' => $chart]);
    }
}
