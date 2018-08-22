<?php

namespace App\Services\ImageUploader;

use Illuminate\Http\UploadedFile;

class ImageUpload
{
    const DEFAULT_MO_IMAGE_PATH = '/storage/uploads/no_image.png';

//    /**
//     * @param $entityObject
//     * @param $request
//     * @return array
//     */
//    private function handleImage($entityObject, $request) : array
//    {
//        $entityId = $entityObject->id;
//        $entityClassName = get_class($entityObject);        // get entity id and entity full class name
//        $path = $this->imageUpload->getImagePath($request);  // get image path
//
//        $this->imageUpload->deleteImage($entityId, $entityObject);
//
//        $data = [
//            'path' => $path,
//            'imageable_id' => $entityId,
//            'imageable_type' => $entityClassName
//        ];
//
//        return $data;                               // return data to CategoriesController to save in DB
//    }

    /**
     * @param $request
     * @return string
     */
    public function getImagePath($request) : ?string
    {
       $path = ($request->hasFile('image')) ? $this->getPath($request->file('image')) : null;

       return $path;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    private function getPath(UploadedFile $uploadedFile) :string
    {
        $path =  $uploadedFile->store('public/uploads');

        return $this->editStoragePath($path);
    }

    /**
     * Edit the path to storage folder
     *
     * @param string $path
     * @return string
     */
    private function editStoragePath(string $path) :string
    {
        return str_replace('public', 'storage', $path);
    }

    /**
     * @param int $entityId
     * @param $entityObject
     */
    public function deleteImage(int $entityId, $entityObject) :void
    {
        if ($entityObject->find($entityId)->image) {
            $entityObject->find($entityId)->image->delete();
        }
    }
}