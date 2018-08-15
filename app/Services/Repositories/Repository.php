<?php

namespace App\Services\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository
{
    protected $className;

    public function __construct()
    {
        $this->className = $this->getClassName();
    }

    abstract protected function getClassName();

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->className::all();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->className::create($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function find($params)
    {
        return $this->className::find($params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateById(int $id, array $params)
    {
        /**
         * @var Model $model
         */
        $model = $this->whereId($id);

        if (! $model) {
            throw new ModelNotFoundException();
        }

        return $model->update($params);
    }

    /**
     * @param  Model $model
     * @param array $params
     * @return bool
     */
    public function AAAAAAupdate(Model $model, array $params)
    {
        return $model->update($params);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function whereId(int $id)
    {
        return $this->className::whereId($id)->first();
    }
}