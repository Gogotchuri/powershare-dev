<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    public static function fromFile(UploadedFile $file, $name)
    {
        $image = new static();
        $image->name = $name;
        $image->url = $file->storePublicly('', 's3');
        $image->save();

        return $image;
    }

    public function campaign() {

    }
}
