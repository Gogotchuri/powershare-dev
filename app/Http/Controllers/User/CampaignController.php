<?php

namespace App\Http\Controllers\User;

use App\HandlesImages;
use App\Http\Requests\User\StoreCampaign;
use App\Http\Requests\User\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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
        $campaign = Campaign::findOrFail($id);

        $this->validate($request, [
            //'featured_images' => 'required'
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

        $this->validate($request, [
            //'featured_images' => 'required'
        ]);

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
}
