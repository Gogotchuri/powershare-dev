<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Reference\CampaignStatus;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::where('status_id', CampaignStatus::APPROVED)->take(30)->get();

        return view('public.home', compact('campaigns'));
    }

    public function terms()
    {
        return view('auth.terms');
    }
}
