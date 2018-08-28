<?php

use App\Models\Role;
use App\Services\Repositories\RoleRepository;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(RoleRepository $roleRepository)
    {
//        DB::table('permissions')->truncate();

        DB::table('permissions')->insert([
            ['id' => '1','permission' => 'accessAdminPanel'],
            ['id' => '2','permission' => 'manageIngredients'],
            ['id' => '3','permission' => 'manageCategories'],
            ['id' => '4','permission' => 'manageDishes'],
            ['id' => '5','permission' => 'addUsers'],
            ['id' => '6','permission' => 'seeUsers'],
            ['id' => '7','permission' => 'deleteUsers'],
            ['id' => '8','permission' => 'editUsers'],
        ]);

        $roleRepository->attachUserPermissions(Role::EDITOR_ID, [1,2,3,4]);
        $roleRepository->attachUserPermissions(Role::ADMIN_ID, [1,2,3,4,6]);
        $roleRepository->attachUserPermissions(Role::SUPER_ADMIN_ID, [1,2,3,4,5,6,7,8]);
    }
}
