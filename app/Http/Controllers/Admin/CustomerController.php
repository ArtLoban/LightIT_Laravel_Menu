<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order\Customer;
use App\Services\Repositories\CustomerRepository;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.customers.index', ['customers' => $this->customerRepository->all()]);
    }


    /**
     * Display the specified resource
     *
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show', ['customer' => $customer]);
    }
}
