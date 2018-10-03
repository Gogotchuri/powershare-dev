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
        //$campaign->video_url = $request->video;
        //$campaign->ethereum_address = $request->ethereum_address;

        /*$featured_images = $request->featured_images;
        $featured_image_entities = [];

        if($featured_images != null) {
            foreach ($featured_images as $featured_image) {
                $image = Image::fromFile($featured_image, 'Featured Image');
                Storage::disk('s3')->url($image->url);

                $featured_image_entities[] = $image;
            }
        }*/

        //$image = Image::fromFile($request->file('featured_image'), 'Featured Image');

        //TODO: Temporary associating empty image, need to decide if create form should have featured image and what
        // kind of input should we use for it jQuery ajax or just input[type=file]

        $image = new Image();
        $image->name = 'Empty image';
        $image->url = 'http://sssa.com';
        $image->save();

        $campaign->featured_image()->associate($image);
        $campaign->save();

        /*foreach ($featured_image_entities as $featured_image_entity) {
            $campaign->images()->save($featured_image_entity);
        }*/

        return redirect(route('admin.campaigns.edit', $campaign->id));
    }

    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.show', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(UpdateCampaign $request, $id)
    {
        //FIXME: TMP
        //FIXME: This parameter can be easily changed by user on front-end.
        // User can assign whichever images he wants to this campaign.
        $imageIds = $request->image_ids;

        //FIXME: END TMP

        $campaign =  Campaign::findOrFail($id);
        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->video_url = $request->video;
        $campaign->ethereum_address = $request->ethereum_address;
        $campaign->status_id = CampaignStatus::idFromName($request->status);
        //$campaign->author_id = Auth::user()->id;

        $featured_images = $request->featured_images;
        $featured_image_entities = [];

        if($featured_images != null) {
            foreach ($featured_images as $featured_image) {
                $image = Image::fromFile($featured_image, 'Featured Image');
                Storage::disk('s3')->url($image->url);

                $featured_image_entities[] = $image;
            }
        }


        //FIXME: TMP disable
        /*$featured_image = $request->featured_image;

        if($featured_image !== null) {
            $image = Image::fromFile($featured_image, 'Featured Image');

            $campaign->featured_image()->delete();
            $campaign->featured_image()->associate($image);
        }*/

        //FIXME: TMP
        if($imageIds !== null && is_array($imageIds)) {

            foreach ($imageIds as $imageId) {
                $image = Image::find($imageId);
                $image->campaign_id = $campaign->id;
                $image->save();
            }

            //dd('we are here', $campaign->images);
        }
        //FIXME: END TMP

        //TODO: We replace old featured pictures should we append?
        //FIXME: TMP disable
        /*$campaign->images()->delete();
        foreach ($featured_image_entities as $featured_image_entity) {
            $campaign->images()->save($featured_image_entity);
        }*/

        $campaign->save();

        return redirect(route('admin.campaigns.show', $campaign->id));
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

        return $campaign->images->map(function ($image, $key) {
            return $this->getImageDescriptor($image);
        });
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
