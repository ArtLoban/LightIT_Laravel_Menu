<?php

namespace App\Services\UploadedFiles;

use Illuminate\Http\UploadedFile;

class ImageUpload
{
    public function putInImagePath(StoreRequest $request) :array
    {
        $this->storeImage($file, $request);
        return ['path' => $imagePath];
    }
//        dd($request->file('image')->store('public/uploads'));

    private function storeImage(UploadedFile $image, $request)
    {
        return $request->file($image)->store('public/uploads');
    }

    private function nullImage()
    {

    }

    public function noImage()
    {
        return 'public/uploads/no_image.png';
    }


}