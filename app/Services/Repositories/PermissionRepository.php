<?php

namespace App\Services\Repositories;

use App\Models\Permission;

class PermissionRepository extends Repository
{
    protected function getClassName()
    {
        return Permission::class;
    }
}