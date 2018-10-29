<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\StoreCampaign;
use App\Http\Requests\User\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignCategory;
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

        $campaigns = $user->campaigns_contributed()->with('author')->get();

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
     * @param StoreCampaign $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaign $request)
    {
        $campaign =  new Campaign();
        $campaign->status_id = CampaignStatus::DRAFT;
        $campaign->name = $request->input('name');
        $campaign->target_audience = $request->input('target_audience');
        $campaign->details = $request->input('details');
        $campaign->author_id = Auth::user()->id;
        $campaign->save();

        return redirect(route('user.campaigns.edit', $campaign->id));
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
        $campaign = $user->campaigns_contributed()->findOrFail($id);
        $stats = $campaign->coinhiveUsers()->where('user_id', Auth::user()->id)->first();

        return view('user.campaigns.show', compact('campaign', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = CampaignCategory::all();
        $campaign = Auth::user()
            ->campaigns()
            ->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])
            ->findOrFail($id);

        return view('user.campaigns.edit', compact('campaign', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCampaign $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaign $request, $id)
    {
        $campaign = Auth::user()
            ->campaigns()
            ->where('status_id', CampaignStatus::DRAFT)
            ->findOrFail($id);

        if ($request->file('featured-image'))
            $image = Image::forFeatured($request->file('featured-image'), 'Featured Image');

        $campaign->name = $request->input('name');
        $campaign->target_audience = $request->input('target_audience');
        $campaign->required_funding = $request->input('required_funding');
        $campaign->category_id = $request->input('category');
        $campaign->details = $request->input('details');
        $campaign->importance = $request->input('importance');
        $campaign->video_url = $request->video;
        $campaign->ethereum_address = $request->ethereum_address;
        $campaign->status_id = $request->input('status_id');
        $campaign->featured_image_id = isset($image) && $image ? $image->id : $campaign->featured_image_id;

        $campaign->save();

        return redirect(route('user.campaigns.show', $campaign->id));
    }

    public function delete($id)
    {
        $user = Auth::user();

        //User can delete only campaigns that have status -> Draft
        $campaign = $user->campaigns()->whereIn('status_id', [CampaignStatus::DRAFT, CampaignStatus::PROPOSAL])->first();

        if(!$campaign) {
            abort(404);
        }

        $campaign->delete();

        return redirect(route('user.campaigns.index'));
    }
}
