<?php

namespace App\Services\Repositories;

use App\Models\Order\Customer;

class CustomerRepository extends Repository
{
    protected function getClassName()
    {
        return Customer::class;
    }


}