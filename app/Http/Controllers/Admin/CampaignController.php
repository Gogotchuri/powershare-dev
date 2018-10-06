<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaign;
use App\Http\Requests\Admin\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();

        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(StoreCampaign $request)
    {
        $campaign =  new Campaign();
        $campaign->status_id = CampaignStatus::idFromName($request->status);
        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->author_id = Auth::user()->id;
        $campaign->save();

        return redirect(route('admin.campaigns.edit', $campaign->id));
    }

    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.show', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = Campaign::where('id', $id)
            ->with(['featured_image', 'images'])
            ->firstOrFail();

        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(UpdateCampaign $request, $id)
    {
        if ($request->file('featured-image'))
            $image = Image::forFeatured($request->file('featured-image'), 'Featured Image');

        $campaign =  Campaign::findOrFail($id);
        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->video_url = $request->video;
        $campaign->ethereum_address = $request->ethereum_address;
        $campaign->status_id = intVal($request->status_id);
        $campaign->featured_image_id = isset($image) && $image ? $image->id : $campaign->featured_image_id;
        $campaign->save();

        return redirect(route('admin.campaigns.show', $campaign->id));
    }

    public function getMainFeaturedImage($id) {
        $campaign = Campaign::findOrFail($id);
        $image = $campaign->featured_image;

        return response()->json(array('files' => $image ? [$this->getImageDescriptor($image)] : []), 200);
    }

    public function handleMainFeaturedImage($id, Request $request) {
        $campaign = Campaign::findOrFail($id);

        $this->validate($request, [
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = Image::fromFile($request->featured_image, 'Featured Image', [
            'fit' => [640, 480],
            'thumbnailFit' => [80, 59]
        ]);

        $campaign->featured_image()->associate($image);
        $campaign->save();

        return response()->json(array('files' => [$this->getImageDescriptor($image)]), 200);
    }

    public function handleFeaturedImages($id, Request $request) {

        $campaign = Campaign::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'featured_images' => 'required|array',
            'featured_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $fileSpecificErrors = $validator->errors()->get('featured_images.*');

            if(count($fileSpecificErrors) > 0) {
                $formattedErrors = $this->createImageErrorResponseArray($fileSpecificErrors, $request->featured_images);
                return response()->json($formattedErrors, 200);
            }
        }

        $image_descriptors = [];
        foreach ($request->featured_images as $featured_image) {

            $image = Image::fromFile($featured_image, 'Featured Image', [
                'fit' => [640, 480],
                'thumbnailFit' => [80, 59]
            ]);

            $campaign->images()->save($image);

            $descriptor = $this->getImageDescriptor($image);

            $image_descriptors[] = $descriptor;
        }

        return response()->json(array('files' => $image_descriptors), 200);
    }

    private function createImageErrorResponseArray(array $errors, array $uploadedFiles) {

        $fileMessages = [];
        $i = 0;
        foreach ($errors as $message) {

            $file = $uploadedFiles[$i];

            $fileMessages[] = [
                'error' => $message[0],
                'name' => $file->getClientOriginalName(),
                'size' => $file->getClientSize()
            ];

            $i++;
        }

        return ['files' => $fileMessages];
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

    public function featuredImageList($id) {
        $campaign = Campaign::findOrFail($id);

        return [
            'files' => $campaign->images->map(function ($image, $key) {
                return $this->getImageDescriptor($image);
            })
        ];
    }

    public function delete($id)
    {
        Campaign::findOrFail($id)->delete();

        return redirect(route('admin.campaigns.index'));
    }

    public function approve($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->is_approved = true;
        $campaign->save();

        return redirect(route('admin.campaigns.edit', $campaign));
    }

    public function unapprove($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->is_approved = false;
        $campaign->save();

        return redirect(route('admin.campaigns.edit', $campaign));
    }

}
