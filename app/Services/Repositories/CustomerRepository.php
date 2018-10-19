<?php

namespace App\Services\Repositories;

use App\Models\Order\Customer;

class CustomerRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Customer::class;
    }
}
