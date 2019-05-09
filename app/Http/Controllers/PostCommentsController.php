<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Comment;
use App\Post;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::all();
        return view('admin.comments.index',compact('comments'));
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
        $validatedComment = $this->validate(
            $request,[
                'body' => 'required|max:255',
            ],
            [
                'body.required' => 'Comment body is required',
                'body.max' => 'Maximum allowed characters 255',
            ]
        );
        $comment = $request->all();
        $user = Auth::user();
        $comment['user_id'] = $user->id;
        Comment::create($comment);
        $request->session()->flash('comment_submitted', 'Your comments has been submitted and awaiting moderation ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        $comments = $post->comment;
        return view('admin.comments.show',compact('comments','post'));
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
        $comment = Comment::findOrFail($id);
        $comment_status = $request->is_active;
        $comment->update(['is_active' => $comment_status]);
        if($comment_status == 0)
            $request->session()->flash('comment_status', 'Comment with ID "'.$comment->id.'" has been successfully unapproved');
        else if($comment_status == 1)
        $request->session()->flash('comment_status', 'Comment with ID "'.$comment->id.'" has been successfully approved');
        return redirect()->route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentToBeDeleted = Comment::findOrFail($id);
        Session::flash('comment_deleted', 'Comment with ID "'.$commentToBeDeleted->id.'" has been successfully deleted');
        $commentToBeDeleted->delete();
        return redirect()->route('comments.index');
        //
    }
}
