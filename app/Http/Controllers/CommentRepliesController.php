<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\CommentReply;
use App\Comment;
use App\Post;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Incoming id is comment id
        $replies = CommentReply::where('comment_id',$id)->get();
        //Getting post data
        $comment = Comment::find($id);
        $postID = $comment->post->id;
        $post = Post::find($postID);
        return view('admin.comments.replies.show',compact('replies','post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $reply = CommentReply::findOrFail($id);
        $reply_status = $request->is_active;
        $reply->update(['is_active' => $reply_status]);
        if($reply_status == 0)
            $request->session()->flash('reply_status', 'Reply with ID "'.$reply->id.'" has been successfully unapproved');
        else if($reply_status == 1)
        $request->session()->flash('reply_status', 'Reply with ID "'.$reply->id.'" has been successfully approved');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $replyToBeDeleted = CommentReply::findOrFail($id);
        Session::flash('reply_deleted', 'Reply with ID "'.$replyToBeDeleted->id.'" has been successfully deleted');
        $replyToBeDeleted->delete();
        return redirect()->back();
    }

    public function createReply(Request $request){
        $validatedComment = $this->validate(
            $request,[
                'body' => 'required|max:255',
            ],
            [
                'body.required' => 'Comment body is required',
                'body.max' => 'Maximum allowed characters 255',
            ]
        );
        $reply = $request->all();
        $user = Auth::user();
        $reply['user_id'] = $user->id;
        CommentReply::create($reply);
        $request->session()->flash('comment_submitted', 'Your comments has been submitted and awaiting moderation ');
        return redirect()->back();
    }
}
