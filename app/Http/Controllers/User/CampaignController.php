<?php

namespace App\Http\Controllers\User;

use App\HandlesImages;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    use HandlesImages;

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
    public function store(Request $request)
    {
        $campaign =  new Campaign();
        $campaign->name = $request->input('name');
        $campaign->details = $request->input('details');
        $campaign->author_id = Auth::user()->id;

        $image = $this->createImage($request->file('featured_image'));

        $campaign->featured_image()->associate($image);
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
        $campaign = $user->campaigns()->findOrFail($id);

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
        $campaign =  Campaign::findOrFail($id);
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
}
