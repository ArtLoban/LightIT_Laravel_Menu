<?php

namespace App\Services\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    protected function getClassName()
    {
        return User::class;
    }
}