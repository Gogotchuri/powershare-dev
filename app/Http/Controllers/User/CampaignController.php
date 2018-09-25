<?php

namespace App\Http\Controllers\User;

use App\HandlesImages;
use App\Http\Requests\User\StoreCampaign;
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
        $campaign->video_url = $request->video;
        $campaign->ethereum_address = $request->ethereum_address;

        $featured_images = $request->featured_images;
        $featured_image_entities = [];

        if($featured_images != null) {
            foreach ($featured_images as $featured_image) {
                $image = Image::fromFile($featured_image, 'Featured Image');

                $featured_image_entities[] = $image;
            }
        }

        $image = Image::fromFile($request->file('featured_image'), 'Featured Image');

        $campaign->featured_image()->associate($image);
        $campaign->save();

        foreach ($featured_image_entities as $featured_image_entity) {
            $campaign->images()->save($featured_image_entity);
        }

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
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $campaign = $user->campaigns()->findOrFail($id);

        //User can update Drafts only
        if(!$campaign->is_draft) {
            return back(403)->withErrors(['user', 'You cannot change campaign that is not draft']);
        }

        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->author_id = Auth::user()->id;

        if($request->featured_image) {
            $image = $this->createImage($request->file('featured_image'), $request->input('name'));
            $campaign->featured_image()->delete();
            $campaign->featured_image()->associate($image);
        }

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
