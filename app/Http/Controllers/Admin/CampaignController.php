<?php

namespace App\Http\Controllers\Admin;

use App\HandlesImages;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Image;
use Illuminate\Http\Request;

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
        $campaigns = Campaign::all();

        return view('admin.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
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

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $this->createImage($request->file('image'));

        $campaign->featured_image()->associate($image);
        $campaign->save();

        return redirect(route('admin.campaigns.show', $campaign->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaign.edit', compact('campaign'));
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

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $this->createImage($request->file('image'), $request->input('name'));

        $campaign->featured_image()->associate($image);
        $campaign->save();

        return redirect(route('admin.campaigns.show', $campaign->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Approve the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->is_approved = true;
        $campaign->save();

        return redirect(route('admin.campaigns.edit', $campaign));
    }

    /**
     * Unapprove the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unapprove($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->is_approved = false;
        $campaign->save();

        return redirect(route('admin.campaigns.edit', $campaign));
    }

}
