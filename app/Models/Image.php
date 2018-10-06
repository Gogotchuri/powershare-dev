<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\FileHelpers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use ImageProcessor;

class Image extends Model
{
    use FileHelpers;

    public static function fromFile(UploadedFile $file, $name, $options = [])
    {
        $image = new static();
        $image->name = $name;
        $image->path = $file->storePublicly('', 's3');
        $image->url = Storage::disk('s3')->url($image->path);
        $image->save();

        $cursor = null;
        if($cursor = array_get($options, 'fit')) {
            if(!is_array($cursor) || count($cursor) !== 2) {
                throw new \Exception('"fit" parameter should be array and have exactly 2 element');
            }

            //TODO: Quality of images are getting very low after fit() call.
            $processedImageData = (string) ImageProcessor::make($file)->fit($cursor[0], $cursor[1])->stream();
            $processedImagePath = $file->hashName();
            Storage::disk('s3')->put($processedImagePath, $processedImageData, ['visibility' => 'public']);

            $image->path = $processedImagePath;

        } else {
            $image->path = $file->storePublicly('', 's3');
        }

        if($cursor = array_get($options, 'thumbnailFit')) {
            if(!is_array($cursor) || count($cursor) !== 2) {
                throw new \Exception('"thumbnailFit" parameter should be array and have exactly 2 element');
            }

            //TODO: Quality of images are getting very low after fit() call.
            $thumbnailImageData = (string) ImageProcessor::make($file)->fit($cursor[0], $cursor[1])->stream();
            $thumbnailImagePath = $file->hashName();
            Storage::disk('s3')->put($thumbnailImagePath, $thumbnailImageData, ['visibility' => 'public']);

            $image->thumbnail_url = Storage::disk('s3')->url($thumbnailImagePath);
            $image->thumbnail_path = $thumbnailImagePath;
        }

        $image->url = Storage::disk('s3')->url($image->path);

        return $image;
    }

    public function campaign() {
        $this->belongsTo(Campaign::class);
    }

    public function getPublicUrlAttribute() {
        return $this->url;
    }
}
