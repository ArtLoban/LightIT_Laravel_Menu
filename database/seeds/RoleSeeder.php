<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Models\Role::class, 3)->create();

        DB::table('roles')->insert([
            ['name' => 'Editor'],
            ['name' => 'Admin'],
            ['name' => 'SuperAdmin']
        ]);
    }

}
