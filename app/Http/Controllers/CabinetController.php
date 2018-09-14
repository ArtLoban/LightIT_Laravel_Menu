<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Services\Repositories\OrderRepository;
use App\Services\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user_cabinet.user_data', ['user' => Auth::user()]);
    }

    /**
     * @param OrderRepository $orderRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUserHistory(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->getAllUserOrdersWithRelations(Auth::user()->getKey());
        return view('user_cabinet.user_history', ['orders' => $orders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, UserRepository $userRepository)
    {
        $userRepository->updateById($request->user()->getKey(), $request->all());
        return back()->with('msg', 'Данные обновлены');
    }

}
