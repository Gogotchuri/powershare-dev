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
        // Check if this is first time visit of user after browser was open
        if(!session()->has('first_time')) {
            session(['first_time' => 'Yes']);
        } else if(session('first_time') === 'Yes') {
            session(['first_time' => 'No']);
        }

        $isFirstTime = session('first_time') === 'Yes';
        $campaigns = Campaign::where('status_id', CampaignStatus::APPROVED)->take(30)->get();

        return view('public.home', compact('campaigns', 'isFirstTime'));
    }

    public function terms()
    {
        return view('auth.terms');
    }
}
