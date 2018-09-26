<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Reference\CampaignStatus;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::where('status_id', CampaignStatus::APPROVED)->take(4)->get();

        return view('public.home', ['campaigns' => $campaigns]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::where('status_id', CampaignStatus::APPROVED)->findOrFail($id);

        return view('public.details', compact('campaign'));
    }
}
