<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreSession;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Session;
use App\User;

class SessionController extends Controller
{
    public function store(StoreSession $request)
    {
        $campaign = Campaign::findOrFail($request->input('campaign_id'));
        $user = User::find($request->input('user_id'));

        $session = new Session();
        $session->campaign_id = $campaign->id;
        $session->user_id = $user ? $user->id : null;
        $session->raw_session = json_encode($request->input('job'));
        $session->save();

        return response()->json(['data' => $session->toArray()]);
    }
}
