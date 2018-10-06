<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\StoreCampaign;
use App\Http\Requests\User\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $campaigns = $user->campaigns;

        return view('user.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaign $request)
    {
        $campaign =  new Campaign();
        $campaign->status_id = CampaignStatus::idFromName($request->status);
        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->author_id = Auth::user()->id;
        $campaign->save();

        return redirect(route('user.campaigns.show', $campaign->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $campaign = $user->campaigns()->findOrFail($id);

        return view('user.campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $campaign = $user->campaigns()->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])->findOrFail($id);

        return view('user.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaign $request, $id)
    {
        $user = Auth::user();
        $campaign = $user->campaigns()->where('status_id', CampaignStatus::DRAFT)->findOrFail($id);

        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->video_url = $request->video;
        $campaign->ethereum_address = $request->ethereum_address;
        $campaign->status_id = CampaignStatus::idFromName($request->status);

        $campaign->save();

        return redirect(route('user.campaigns.show', $campaign->id));
    }

    public function delete($id)
    {
        $user = Auth::user();

        //User can delete only campaigns that have status -> Draft
        $user->campaigns()->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])->findOrFail()->delete();

        return redirect(route('admin.campaigns.index'));
    }

    public function getMainFeaturedImage($id) {
        $campaign = Campaign::findOrFail($id);
        $image = $campaign->featured_image;

        return response()->json(array('files' => $image ? [$this->getImageDescriptor($image)] : []), 200);
    }

    public function handleMainFeaturedImage($id, Request $request) {

        $user = Auth::user();

        $campaign = $user->campaigns()->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])->firstOrFail();

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

        $user = Auth::user();

        $campaign = $user->campaigns()->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])->firstOrFail();

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

        $user = Auth::user();

        $campaign = $user->campaigns()->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])->firstOrFail();

        return [
            'files' => $campaign->images->map(function ($image, $key) {
                return $this->getImageDescriptor($image);
            })
        ];
    }
}
