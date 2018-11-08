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
    public function index()
    {
        $campaigns = Campaign::where('status_id', CampaignStatus::APPROVED)->orderBy('created_at', 'desc')->paginate(8);

        return view('public.home', compact('campaigns'));
    }

    public function terms()
    {
        return view('auth.terms');
    }

    public function campaigns(Request $request)
    {
        $query = Campaign::where('status_id', CampaignStatus::APPROVED);

        if($category = $request->input('category_id') !== null) {
            $query->where('category_id', $category);
        }

        if($name = $request->input('name') !== null) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return response()->json($query->paginate());
    }
}
