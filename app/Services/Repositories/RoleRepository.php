<?php

namespace App\Services\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Role::class;
    }

    /**
     * @param int $roleName
     * @param array $permissionsSet
     */
    public function attachUserPermissions(int $roleName, array $permissionsSet)
    {
        $this->className::find($roleName)->permissions()->attach($permissionsSet);
    }
}
