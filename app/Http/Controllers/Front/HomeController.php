<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Reference\CampaignStatus;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campaigns = Campaign::where('status_id', CampaignStatus::APPROVED)->paginate(8);

        if($request->ajax()) {
            sleep(5);
        }

        return view('public.home', compact('campaigns'));
    }

    public function terms()
    {
        return view('auth.terms');
    }
}
