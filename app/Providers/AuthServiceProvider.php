<?php

namespace App\Providers;

use App\Models\Permission;
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

        Auth::loginUsingId(1);

        /*Gate::define('accessAdminPanel', function ($user) {
            return $user->id == 5;
        });*/

        // Dynamically register permissions with Laravel's Gate
        foreach ($this->getPermissions() as $permission) {

            $user = auth()->user();
            $userPermissions = $user->role()->with('permissions')->get()->first()->permissions;
//            $userPermissions->contains($permission->permission);
            dd($permission->permission);
            dd($userPermissions->contains($permission->permission));

            Gate::define($permission->permission, function ($user) use ($permission) {

                $user = auth()->user();
                $userPermissions = $user->role()->with('permissions')->get();

                return $userPermissions->contains($permission->permission);
            });
        }

        /*foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->permission, function ($user) use ($permission) {

                return $user->hasPermission($permission);
            });
        }*/
    }

    /**
     * Fetch the Collection of site permissions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
