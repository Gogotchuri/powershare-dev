<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
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
                'size' => Storage::disk('s3')->size($image->path),
                'url' => $image->url,
                'thumbnailUrl' => $image->url,
                'deleteUrl' => route('image.delete', ['id' => $image->id]),
                'deleteType' => 'DELETE',
                'id' => $image->id,
            ];

            $image_descriptors[] = $descriptor;
        }

        return response()->json(array('files' => $image_descriptors), 200);
    }

    public function existing(Request $request) {

        $this->validate($request, [
            'campaignId' => 'required'
        ]);

        $images = Campaign::findOrFail($request->campaignId)->images;

        $image_descriptors = [];

        foreach ($images as $image) {
            $image_descriptors[] = $this->getImageDescriptor($image);
        }

        return response()->json(array('files' => $image_descriptors), 200);
    }

    public function delete($id) {
        $image = Image::findOrFail($id);

        Storage::disk('s3')->delete($image->path);
        $image->delete();

        $descriptor = [
            'name' => basename($image->path),
            'size' => Storage::disk('s3')->size($image->path),
            'url' => $image->url,
            'thumbnailUrl' => $image->url,
            'deleteUrl' => route('image.delete', ['id' => $image->id]),
            'deleteType' => 'DELETE',
            'id' => $image->id,
        ];

        return [
            'files' => [
                $descriptor
            ]
        ];
    }

    private function getImageDescriptor(Image $image, $uploaded_image=null) {

        return [
            'name' => $uploaded_image !== null ? $uploaded_image->getClientOriginalName() : basename($image->path),
            'size' => Storage::disk('s3')->size($image->path),
            'url' => $image->url,
            'thumbnailUrl' => $image->url,
            'deleteUrl' => route('image.delete', ['id' => $image->id]),
            'deleteType' => 'DELETE',
            'id' => $image->id,
        ];
    }
}
