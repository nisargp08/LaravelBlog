<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\Photo;
use App\Category;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(10);
        return view('admin.posts.index',compact('posts'));
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
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
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
        return redirect()->route('posts.index');
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
        $post = Post::find($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $postData = $request->all();
        if($file = $request->file('photo_id')){
            if(!is_null($post['photo_id'])){
                if(\file_exists(public_path().$post->photo->file)){
                    /*Deleting image from the 'images' folder*/
                    unlink(public_path().$post->photo->file);
                    /*Deleting the photo from the photo table*/
                    $post->photo->delete();
                }
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file' => $name]);
            $postData['photo_id'] = $photo->id;
        }
        //Auth::user()->post()->whereId($id)->first()->update($postData);
        $post->update($postData);
        Session::flash('post_updated','Post "'.$post->title.'" has been successfully updated');
        return redirect()->route('posts.index');
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
        $postToBeDeleted = Post::findOrFail($id);
        if(!is_null($postToBeDeleted['photo_id'])){
            if(\file_exists(public_path().$postToBeDeleted->photo->file)){
            /*Deleting image from the 'images' folder*/
            unlink(public_path().$postToBeDeleted->photo->file);
            /*Deleting the photo from the photo table*/
            $postToBeDeleted->photo->delete();
            }
        }
        $postToBeDeleted->delete();
        Session::flash('post_deleted','Post "'.$postToBeDeleted->title.'" has been successfully deleted.');
        return redirect()->route('posts.index');
    }
}
