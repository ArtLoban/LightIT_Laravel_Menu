<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Services\Repositories\PermissionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Models\User' => 'App\Policies\UserPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Auth::loginUsingId(3);

        $permissions = $this->getPermissions(); // Получаю список всех permisssions

        foreach ($permissions as $permission) {  // через цикл формирую правила для каждого permission в Laravel's Gate

            Gate::define($permission->permission, function($user) use($permission) {

                $permissions = $user->getAllPermissions();  // Получаю список всех разрешений для залогиненого пользователя

                if ($permissions->contains('permission', $permission->permission)) { // СРавниваю есть ли у польз нужное разрешние
                    return true;
                }

                return false;
            });
        }

        /*Gate::define('seeUsers', function($user) {

            $permissions = $user->getAllPermissions();

            if ($permissions->contains('permission', 'seeUsers')) {
                return true;
            }

            return false;
        });*/


    }

    /**
     * Fetch the Collection of site permissions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::all();
    }
}