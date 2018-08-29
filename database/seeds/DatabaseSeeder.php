<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionsSeeder::class,
            CategorySeeder::class,
            IngredientSeeder::class,
            UserSeeder::class,
            ImageSeeder::class,
            DishSeeder::class,
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
