<?php

namespace App\Services\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
     * @param $params
     * @return mixed
     */
    public function save()
    {
        return $this->className::save();
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
     * @param int $id
     * @return Model|null
     */
    public function whereId(int $id)
    {
        return $this->className::whereId($id)->first();
    }

    /**
     * @param $entityObject
     * @param $request
     * @return array
     */
    private function handleImage($entityObject, $request) : array
    {
        $entityId = $entityObject->id;
        $entityClassName = get_class($entityObject);        // get entity id and entity full class name
        $path = $this->imageUpload->getImagePath($request);  // get image path

        $this->imageUpload->deleteImage($entityId, $entityObject);

        $data = [
            'path' => $path,
            'imageable_id' => $entityId,
            'imageable_type' => $entityClassName
        ];

        return $data;                               // return data to CategoriesController to save in DB
    }

    /**
     * @param $request
     * @param $entityObject
     * @param $imageRepository
     */
    public function saveImage($request, $entityObject, $imageRepository)
    {
        if($request->hasFile('image')) {
            $data = $imageRepository->handleImage($entityObject, $request);
            $imageRepository->create($data);
        }
    }

}