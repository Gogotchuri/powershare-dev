<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    public static function fromFile(UploadedFile $file, $name)
    {
        $image = new static();
        $image->name = $name;
        $image->url = Storage::disk('s3')->url($file->storePublicly('', 's3'));
        $image->save();

        return $image;
    }

    public function campaign() {
        $this->belongsTo(Campaign::class);
    }

    public function getPublicUrlAttribute() {
        return $this->url;
    }
}
