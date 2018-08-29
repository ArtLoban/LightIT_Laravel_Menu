<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {

    static $order = 1;

    return [
        'name' => 'Категория '. $order++,
        'description' => $faker->realText(300)
    ];
});
