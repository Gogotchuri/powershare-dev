<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as IntImage;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaignId)
    {
        return view('admin.members.create', compact('campaignId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($campaignId, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $member = new TeamMember();
        $member->name = $request->input('name');

        $image = Image::forTeamMember($request->file('icon'), $request->input('name'));

        $member->image_url = $image->url;
        $member->campaign_id = $campaignId;
        $member->save();

        //TODO: Return message too..
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = new TeamMember();

        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TeamMember::findOrFail($id)->delete();

        //TODO: Return message too..
        return back();
    }
}
