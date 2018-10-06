<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\FileHelpers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as IntImage;


class Image extends Model
{
    public $visible = ['url'];

    public static function forCampaign(UploadedFile $file, Campaign $campaign)
    {
        $image = new static();
        $image->name = $campaign->name;
        $image->storeNormal($file);
        $image->storeThumbnail($file);
        $image->campaign_id = $campaign->id;
        $image->save();

        return $image;
    }

    public function campaign() {
        $this->belongsTo(Campaign::class);
    }

    public function storeNormal(UploadedFile $file)
    {
        $content = IntImage::make($file->path())
            ->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->stream()
            ->detach();

        $this->url = $this->upload('powershare-'.$file->hashName(), $content);
    }

    public function storeThumbnail(UploadedFile $file)
    {
        $content = IntImage::make($file->path())
            ->fit(320, 240)
            ->stream()
            ->detach();

        $this->thumbnail_url = $this->upload('powershare-thumbnail-'.$file->hashName(), $content);
    }

    public function upload($name, $content)
    {
        Storage::disk('s3')->put($name, $content, 'public');

        return Storage::disk('s3')->url($name);
    }
}
