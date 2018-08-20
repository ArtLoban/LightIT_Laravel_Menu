<?php

namespace App\Services\Repositories;

use App\Models\User;
use App\Services\ImageUploader\ImageUpload;
use Illuminate\Support\Facades\Hash;


class UserRepository extends Repository
{
    /**
     * Instance of App\Services\ImageUploader\ImageUpload
     * @var ImageUpload
     */
    private $imageUpload;

    /**
     * UserRepository constructor.
     * @param ImageUpload $imageUpload
     */
    public function __construct(ImageUpload $imageUpload)
    {
        parent::__construct();
        $this->imageUpload = $imageUpload;
    }

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