<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Ingredient::class, function (Faker $faker) {

    static $order = 1;

    return [
        'name' => 'Ингредиент '. $order++,
        'description' => $faker->realText(300)
    ];
});
