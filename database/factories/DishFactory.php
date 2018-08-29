<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Dish::class, function (Faker $faker) {

    static $order = 1;

    return [
        'name' => 'Блюдо '. $order++,
        'description' => $faker->realText(300),
        'category_id' => $faker->numberBetween(1, 10),
        'price' => $faker->numberBetween(100, 700),
        'weight' => $faker->numberBetween(100, 450),
    ];
});
