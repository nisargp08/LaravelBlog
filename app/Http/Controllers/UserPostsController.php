<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostRequest;
use App\Category;
use App\Photo;

class UserPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::where('user_id',Auth::user()->id)->get();
        return view('userposts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();
        return view('userposts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        /*Fetching all the data from the form*/
        $post = $request->all();
        /*Fetching the name of the author who created the blog*/
        $blogAuthor = Auth::user();
        /*Fetching the photo if uploaded*/
        if($file = $request->file('photo_id')){
            /*Fetching filename and appending current time to it*/
            $name = time() . $file->getClientOriginalName();
            /*Moving the file to images folder*/
            $file->move('images',$name);
            /*Adding photo to the database*/
            $photo = Photo::create(['file' => $name]);
            /*Fetching the id of the stored photo and saving it in the array*/
            $post['photo_id'] = $photo->id;
        }
        $blogAuthor->post()->create($post);
        Session::flash('post_created',"Post has been successfully created");
        return redirect()->route('userposts.index');
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
    }
}
