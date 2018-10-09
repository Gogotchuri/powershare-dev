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
     * @param StoreCampaign $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaign $request)
    {
        $campaign =  new Campaign();
        $campaign->status_id = CampaignStatus::DRAFT;
        $campaign->name = $request->input('name');
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
        $campaign = Auth::user()
            ->campaigns()
            ->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])
            ->findOrFail($id);

        return view('user.campaigns.edit', compact('campaign'));
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
        $campaign->details = $request->input('details');
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
        $user->campaigns()->where(['id' => $id, 'status_id' => CampaignStatus::DRAFT])->findOrFail()->delete();

        return redirect(route('admin.campaigns.index'));
    }
}
