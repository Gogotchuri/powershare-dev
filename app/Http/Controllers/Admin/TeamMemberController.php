<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as IntImage;

class TeamMemberController extends Controller
{
    public function index($campaignId)
    {
        $members = Campaign::findOrFail($campaignId)->members;

        return response()->json(['data' => $members->toArray()]);
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $member = new TeamMember();
        $member->name = $request->input('name');

        $image = Image::forTeamMember($request->file('image'), $request->input('name'));

        $member->image_url = $image->url;
        $member->campaign_id = $campaignId;
        $member->save();

        return response()->json(['data' => $member->toArray()]);
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

        return response()->json(['data' => 'OK']);
    }
}
