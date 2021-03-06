<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Reference\CampaignCategory;
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
        $categories = CampaignCategory::all();

        return view('public.home', compact('campaigns', 'categories'));
    }

    public function terms()
    {
        return view('auth.terms');
    }

    public function campaigns(Request $request)
    {
        $query = Campaign::where('status_id', CampaignStatus::APPROVED);

        $category = $request->input('category_id');
        $name = $request->input('name');

        if($category !== null) {
            $query->where('category_id', $category);
        }

        if($name !== null) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return response()->json(['data' => $query->get()]);
    }
}
