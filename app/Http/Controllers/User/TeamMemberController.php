<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\Reference\CampaignStatus;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as IntImage;

class TeamMemberController extends Controller
{
    public function index($campaignId)
    {
        // Check if user can editd this campaign
        $this->canEditCampaignId($campaignId);

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
        $member = TeamMember::findOrFail($id);

        // Check if user can editd this campaign
        $this->canEditCampaignId($member->campaign_id);

        $member->delete();

        return response()->json(['data' => 'OK']);
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
