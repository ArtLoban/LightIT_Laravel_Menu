<?php

use App\Models\Order\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone_number' => '0973301333',
        'session_id' => 'test_velue',
    ];
});
