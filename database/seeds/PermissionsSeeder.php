<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['permission' => 'ManageIngredients'],
            ['permission' => 'ManageCategories'],
            ['permission' => 'ManageDishes'],
            ['permission' => 'AddUsers'],
            ['permission' => 'SeeUsers'],
            ['permission' => 'DeleteUsers'],
            ['permission' => 'EditUsers'],
        ]);
    }
}
