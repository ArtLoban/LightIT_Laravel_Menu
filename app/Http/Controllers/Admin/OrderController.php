<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Services\Repositories\OrderRepository;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = $this->orderRepository->getAllWithRelations();

        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        $specificOrder = $this->orderRepository->getWithRelation($order->getKey());
        return view('admin.orders.show', ['order' => $specificOrder]);
    }

}
