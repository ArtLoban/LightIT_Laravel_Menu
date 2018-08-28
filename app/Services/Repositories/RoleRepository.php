<?php

namespace App\Services\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    protected function getClassName()
    {
        return Role::class;
    }

    public function attachUserPermissions(int $roleName, array $permissionsSet)
    {
        $this->className::find($roleName)->permissions()->attach($permissionsSet);
    }
}