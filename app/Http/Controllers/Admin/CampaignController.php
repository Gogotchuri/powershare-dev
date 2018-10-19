<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaign;
use App\Http\Requests\Admin\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignCategory;
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
        $categories = CampaignCategory::all();

        return view('admin.campaigns.create', compact('categories'));
    }

    public function store(StoreCampaign $request)
    {
        $campaign =  new Campaign();
        $campaign->status_id = CampaignStatus::DRAFT;
        $campaign->name = $request->input('name');
        $campaign->target_audience = $request->input('target_audience');
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
        $categories = CampaignCategory::all();
        $campaign = Campaign::where('id', $id)
            ->with(['featured_image', 'images'])
            ->firstOrFail();

        return view('admin.campaigns.edit', compact('campaign', 'categories'));
    }

    public function update(UpdateCampaign $request, $id)
    {
        if ($request->file('featured-image'))
            $image = Image::forFeatured($request->file('featured-image'), 'Featured Image');

        $campaign =  Campaign::findOrFail($id);
        $campaign->name = $request->input('name');
        $campaign->target_audience = $request->input('target_audience');
        $campaign->required_funding = $request->input('required_funding');
        $campaign->category_id = $request->input('category');
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
