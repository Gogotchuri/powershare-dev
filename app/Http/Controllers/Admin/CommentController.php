<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreComment;
use App\Models\Campaign;
use App\Models\Comment;
use App\User;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with(['author', 'campaigns'])->get();

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        //FIXME: We are using these for select boxes but they may become very long lists.
        $users = User::all();
        $campaigns = Campaign::all();

        return view('admin.comments.edit', compact('comment', 'users', 'campaigns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreComment $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $comment->body = $request->body;
        $comment->campaign_id = $request->campaign;
        $comment->author_id = $request->author;
        $comment->date = $request->date;
        $comment->is_public = (bool)$request->status;

        $comment->save();

        return redirect(route('admin.comments.edit', ['id' => $comment->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Comment::findOrFail($id)->delete();

        return redirect(route('admin.comments.index'));
    }
}
