<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Role::class, function (Faker $faker) {
    return [
        'name' => 'Editor',
        'name' => 'Admin',
        'name' => 'SuperAdmin',
    ];
});
