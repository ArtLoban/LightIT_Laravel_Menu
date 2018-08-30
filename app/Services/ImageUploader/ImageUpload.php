<?php

namespace App\Services\ImageUploader;

use App\Models\Image;
use App\Services\Image\Contracts\HasImage;
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
    public function store(UploadedFile $uploadedFile, HasImage $owner)
    {
        $params = $this->getStoreParams($uploadedFile, $owner);
        $this->removePreviousImage($owner);

        return $this->imageRepository->create($params);
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    private function removePreviousImage(HasImage $model)
    {
        if ($model->getImage()) {
            return $this->imageRepository->delete($model->getImage());
        }

        return false;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param Model $model
     * @return array
     */
    private function getStoreParams(UploadedFile $uploadedFile, HasImage $owner): array
    {
        return [
            Image::PATH => $this->getPath($uploadedFile),
            Image::IMAGEABLE_TYPE => $owner->ownerType(),
            Image::IMAGEABLE_ID => $owner->ownerId(),
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