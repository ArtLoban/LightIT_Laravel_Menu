<?php

namespace App\Http\Controllers\Order;

use App\Services\Repositories\DishOrderRepository;
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
}
