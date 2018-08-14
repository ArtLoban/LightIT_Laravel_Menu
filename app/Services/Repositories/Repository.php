<?php

namespace App\Services\Repositories;


abstract class Repository
{
    protected $className;

    public function __construct()
    {
        $this->className = $this->getClassName();
    }

    abstract protected function getClassName();

    public function all()
    {
        return $this->className::all();
    }

    public function create(array $params)
    {
        return $this->className::create($params);
    }

    public function find($params)
    {
        return $this->className::find($params);
    }

    public function update($params)
    {
        return $this->className::update($params);
    }
}