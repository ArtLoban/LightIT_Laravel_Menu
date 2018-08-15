<?php

namespace App\Services\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository extends Repository
{
    protected function getClassName()
    {
        return User::class;
    }

    /**
     * Store a newly created resource in storage with hashed password field.
     *
     * @param  \Illuminate\Http\Request  $params
     */
    public function create(array $params)
    {
        if ($params['password']) {
            $params['password'] = Hash::make($params['password']);
        }

        return $this->className::create($params);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function update(array $params)
    {
        if ($params['password']) {
            $params['password'] = Hash::make($params['password']);
        } elseif ($params['password'] === null) {
            unset($params['password']);
        }

        return $this->className::update($params);
    }
}