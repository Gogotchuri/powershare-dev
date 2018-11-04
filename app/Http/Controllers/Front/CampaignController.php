<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StoreComment;
use App\Models\Campaign;
use App\Models\Comment;
use App\Models\Reference\CampaignStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function show($id)
    {
        $campaign = Campaign::where('status_id', CampaignStatus::APPROVED)->findOrFail($id);

        if(Auth::check()) {
            $comments = $campaign->comments()->where('author_id', Auth::user()->id)->get();
        } else {
            $comments = $campaign->public_comments;
        }

        return view('public.details', compact('campaign', 'comments'));
    }

    public function addComment($id, Request $request)
    {
        $this->validate($request, [
            'body' => 'required|string'
        ]);

        $campaign = Campaign::where('status_id', CampaignStatus::APPROVED)->findOrFail($id);

        $comment = new Comment();
        $comment->author_id = Auth::user()->id;
        $comment->body = $request->input('body');
        $comment->is_public = true;

        $campaign->comments()->save($comment);

        return redirect(route('public.campaign.show', compact('campaign')));
    }
}
