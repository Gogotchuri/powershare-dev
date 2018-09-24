<?php
/**
 * Created by PhpStorm.
 * User: giga
 * Date: 9/24/18
 * Time: 12:30 PM
 */

namespace App;


use App\Models\Image;
use Illuminate\Http\UploadedFile;

trait HandlesImages
{
    protected function putImage(UploadedFile $image) {

        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = storage_path('/app/public/images');

        $image->move($destinationPath, $input['imagename']);

        return asset('/storage/images/' . $input['imagename']);
    }

    protected function createImage(UploadedFile $uploadedImage, string $name = '') {

        $publicUrl = $this->putImage($uploadedImage);

        $image = new Image();
        $image->name = $name;
        $image->url = $publicUrl;
        $image->save();

        return $image;
    }
}
