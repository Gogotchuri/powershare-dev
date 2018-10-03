<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Image;
use Illuminate\Http\FileHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use ImageProcessor;

class ImageController extends Controller
{
    public function upload(Request $request) {
        $image_descriptors = [];
        foreach ($request->featured_images as $featured_image) {

            //TODO: Quality of images are getting very low after fit() call.
            //TODO: Define best size here
            $processedImageData = (string) ImageProcessor::make($featured_image)->fit(640, 480)->stream();
            $thumbnailImageData = (string) ImageProcessor::make($featured_image)->fit(80, 59)->stream();

            //Relatives
            $processedImagePath = $featured_image->hashName();
            $thumbnailImagePath = 'thumbnails/'. $featured_image->hashName();

            //TODO: Move it in Image Model class and create method like fromStream or something like that.
            // Or maybe add third options parameter to from file and pass array of processing values
            //FIXME: Should we check for success here?
            Storage::disk('s3')->put($processedImagePath, $processedImageData, ['visibility' => 'public']);
            Storage::disk('s3')->put($thumbnailImagePath, $thumbnailImageData, ['visibility' => 'public']);

            //dd(Storage::disk('s3')->url($processedImagePath), Storage::disk('s3')->url($thumbnailImagePath));

            $image = new Image();
            $image->name = 'Featured image';
            $image->url = Storage::disk('s3')->url($processedImagePath);
            $image->path = $processedImagePath;
            $image->thumbnail_url = Storage::disk('s3')->url($thumbnailImagePath);
            $image->thumbnail_path = $thumbnailImagePath;
            $image->save();

            //$image = Image::fromFile($featured_image, 'Featured Image');

            $descriptor = [
                'name' => $featured_image->getClientOriginalName(),
                'size' => Storage::disk('s3')->size($image->path),
                'url' => $image->url,
                'thumbnailUrl' => $image->thumbnail_url,
                'deleteUrl' => route('image.delete', ['id' => $image->id]),
                'deleteType' => 'DELETE',
                'id' => $image->id,
            ];

            //dd($descriptor);

            $image_descriptors[] = $descriptor;
        }

        return response()->json(array('files' => $image_descriptors), 200);
    }

    public function createThumbnail(Image $image) {

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

    public function delete(Request $request) {

        $this->validate($request, [
            'id' => 'required'
        ]);

        $image = Image::findOrFail($request->id);

        $descriptor = $this->getImageDescriptor($image);

        Storage::disk('s3')->delete($image->path);
        Storage::disk('s3')->delete($image->thumbnail_path);

        $image->delete();

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
            'thumbnailUrl' => $image->thumbnail_url,
            'deleteUrl' => route('image.delete', ['id' => $image->id]),
            'deleteType' => 'DELETE',
            'id' => $image->id,
        ];
    }
}
