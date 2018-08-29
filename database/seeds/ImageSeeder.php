<?php

use App\Models\Role;
use App\Models\User;
use App\Services\Repositories\ImageRepository;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ImageRepository $imageRepository)
    {
        DB::table('images')->insert([
            ['id' => '1','path' => 'storage/uploads/editor.jpeg', 'imageable_id' => 1, 'imageable_type' => User::class],
            ['id' => '2','path' => 'storage/uploads/admin.jpeg', 'imageable_id' => 2, 'imageable_type' => User::class],
            ['id' => '3','path' => 'storage/uploads/superAdmin.jpeg', 'imageable_id' => 3, 'imageable_type' => User::class],
        ]);

        $imageRepository->attachUsersImages(Role::EDITOR_ID, [1]);
        $imageRepository->attachUsersImages(Role::ADMIN_ID, [2]);
        $imageRepository->attachUsersImages(Role::SUPER_ADMIN_ID, [3]);
    }
}
