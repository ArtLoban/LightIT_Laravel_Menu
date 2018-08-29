<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Dish::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(300),
        'category_id' => $faker->numberBetween(1, 10),
        'price' => $faker->numberBetween(100, 700),
        'weight' => $faker->numberBetween(100, 450),
    ];
});
