<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request) {

        $image_descriptors = [];
        foreach ($request->featured_images as $featured_image) {

            $image = Image::fromFile($featured_image, 'Featured Image');

            $descriptor = [
                'name' => $featured_image->getClientOriginalName(),
                'size' => round(Storage::disk('s3')->size($image->path) / 1024, 2),
                'url' => $image->url,
                'id' => $image->id,
            ];

            $image_descriptors[] = $descriptor;
        }

        return response()->json(array('files' => $image_descriptors), 200);
    }
}
