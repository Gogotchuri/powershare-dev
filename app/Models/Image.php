<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\FileHelpers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Psr\Http\Message\StreamInterface;

class Image extends Model
{
    use FileHelpers;

    public static function fromFile(UploadedFile $file, $name)
    {
        $image = new static();
        $image->name = $name;
        $image->path = $file->storePublicly('', 's3');
        $image->url = Storage::disk('s3')->url($image->path);
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
