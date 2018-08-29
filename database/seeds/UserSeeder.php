<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Editor Name',
            'email' => 'editor@mail.com',
            'password' => bcrypt(111111),
            'role_id' => 1,
            'remember_token' => str_random(10)],

            ['name' => 'Admin Name',
            'email' => 'admin@mail.com',
            'password' => bcrypt(111111),
            'role_id' => 2,
            'remember_token' => str_random(10)],

            ['name' => 'SuperAdmin Name',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt(111111),
            'role_id' => 3,
            'remember_token' => str_random(10)]

        ]);

        factory(\App\Models\User::class, 5)->create();
    }
}
