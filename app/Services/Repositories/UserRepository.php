<?php

namespace App\Services\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    protected function getClassName()
    {
        return User::class;
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAllWith(array $relations)
    {
        return $this->className::with($relations)->get();
    }

    /**
     * Store a newly created resource in storage with hashed password field.
     *
     * @param  \Illuminate\Http\Request  $params
     */
    public function create(array $params)
    {
        if ($params['password']) {
            $params['password'] = bcrypt($params['password']);
        }
        return $this->className::create($params);
    }

}