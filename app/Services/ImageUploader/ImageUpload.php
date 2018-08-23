<?php

namespace App\Services\ImageUploader;

use App\Models\Image;
use App\Services\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageUpload
{
    const DEFAULT_MO_IMAGE_PATH = '/storage/uploads/no_image.png';

    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * ImageUpload constructor.
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * Сохраняет загруженный файл из объекта формы UploadedFile для соотв. модели сущности
     * @param UploadedFile $uploadedFile
     * @param Model $model
     * @return mixed
     */
    public function store(UploadedFile $uploadedFile, Model $model)
    {
        $params = $this->getStoreParams($uploadedFile, $model);
        $this->removePreviousImage($model);

        return $this->imageRepository->create($params);
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    private function removePreviousImage(Model $model)
    {
        if (method_exists($model, 'image') && $model->image) {
            return $this->imageRepository->delete($model->image);
        }

        return false;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param Model $model
     * @return array
     */
    private function getStoreParams(UploadedFile $uploadedFile, Model $model): array
    {
        return [
            Image::PATH => $this->getPath($uploadedFile),
            Image::IMAGEABLE_TYPE => get_class($model),
            Image::IMAGEABLE_ID => $model->getKey(),
        ];
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    private function getPath(UploadedFile $uploadedFile): string
    {
        $path = $uploadedFile->store('public/uploads');

        return $this->editStoragePath($path);
    }

    /**
     * Edit the path to storage folder
     *
     * @param string $path
     * @return string
     */
    private function editStoragePath(string $path): string
    {
        return str_replace('public', 'storage', $path);
    }
}