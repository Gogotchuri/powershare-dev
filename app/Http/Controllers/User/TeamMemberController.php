<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Reference\CampaignStatus;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as IntImage;

class TeamMemberController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaignId)
    {
        // Check if user can editd this campaign
        $this->canEditCampaignId($campaignId);

        return view('user.members.create', compact('campaignId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($campaignId, Request $request)
    {
        // Check if user can editd this campaign
        $this->canEditCampaignId($campaignId);

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

        return back()->with('message', 'New team member "'. $member->name .'" added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);

        // Check if user can editd this campaign
        $this->canEditCampaignId($member->campaign_id);

        return view('user.members.edit', compact('member'));
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
        $member = TeamMember::findOrFail($id);

        // Check if user can editd this campaign
        $this->canEditCampaignId($member->campaign_id);

        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if($rawImage = $request->file('image')) {
            $image = Image::forTeamMember($rawImage, $request->input('name'));
            $member->image_url = $image->url;
        }

        $member->name = $request->input('name');
        $member->save();

        return back()->with('message', 'Team member updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);

        // Check if user can editd this campaign
        $this->canEditCampaignId($member->campaign_id);

        $member->delete();

        return back()->with('message', 'Team member deleted');
    }

    private function canEditCampaignId($campaignId) {

        //If user owns campaign and campaign is draft, user can edit it, otherwise abort
        if(Auth::user()->campaigns()->where([
                'id' => $campaignId,
                'status_id' => CampaignStatus::DRAFT, ])->count() < 1) {
            abort(404);
        }
    }
}
