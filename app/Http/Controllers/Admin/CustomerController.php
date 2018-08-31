<?php

namespace App\Http\Controllers\Admin;

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

    public function index()
    {
        return view('admin.customers.index', ['customers' => $this->customerRepository->all()]);
    }
}
