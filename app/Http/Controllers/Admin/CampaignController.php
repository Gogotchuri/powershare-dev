<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaign;
use App\Http\Requests\Admin\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignStatus;
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
        $campaign->video_url = $request->video;
        $campaign->ethereum_address = $request->ethereum_address;

        $featured_images = $request->featured_images;
        $featured_image_entities = [];

        if($featured_images != null) {
            foreach ($featured_images as $featured_image) {
                $image = Image::fromFile($featured_image, 'Featured Image');
                Storage::disk('s3')->url($image->url);

                $featured_image_entities[] = $image;
            }
        }

        $image = Image::fromFile($request->file('featured_image'), 'Featured Image');

        $campaign->featured_image()->associate($image);
        $campaign->save();

        foreach ($featured_image_entities as $featured_image_entity) {
            $campaign->images()->save($featured_image_entity);
        }

        return redirect(route('admin.campaigns.show', $campaign->id));
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
        $campaign =  Campaign::findOrFail($id);
        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->author_id = Auth::user()->id;

        if($request->featured_image) {
            $image = Image::fromFile($request->file('featured_image'), 'Featured Image');
            $campaign->featured_image()->delete();
            $campaign->featured_image()->associate($image);
        }

        $campaign->save();

        return redirect(route('admin.campaigns.show', $campaign->id));
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
