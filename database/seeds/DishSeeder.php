<?php

use App\Services\Repositories\DishRepository;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(DishRepository $dishRepository)
    {
        factory(\App\Models\Dish::class, 25)->create();

        for($id=1; $id<=25; $id++) {
            $array = $this->randomArray(1,25, mt_rand(1,5));
            $dishRepository->attachIngredientsById($id, $array);
        }
    }

    /**
     * Returns a random array of integers
     *
     * @param $min
     * @param $max
     * @param $quantity
     * @return array
     */
    public function randomArray(int $min, int $max, int $quantity): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);

        return array_slice($numbers, 0, $quantity);
    }

}
