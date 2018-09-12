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

    public function findBy(array $params)
    {
        return $this->className::where($params)->get();
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
     * @param $params
     * @return mixed
     */
    public function with($params)
    {
        return $this->className::with($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function save()
    {
        return $this->className::save();
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
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

        $model->update($params);

        return $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function whereId(int $id)
    {
        return $this->className::whereId($id)->first();
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById(int $id)
    {
        $model = $this->whereId($id);

        if (! $model) {
            throw new ModelNotFoundException();
        }

        return $this->delete($model);
    }

}