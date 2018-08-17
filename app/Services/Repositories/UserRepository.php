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
     * @param array $relations
     * @return mixed
     */
    public function getAllWith(array $relations)
    {
//        dd($this->className::with($relations)->get());
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
            $params['password'] = Hash::make($params['password']);
        }
        return $this->className::create($params);
    }
}