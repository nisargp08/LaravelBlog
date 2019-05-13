<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Photo;
class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $media = Photo::all();
        return view('admin.media.index',compact('media'));
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

        if($file = $request->file('file')){
             /*Fetching filename and appending current time to it*/
             $name = time() . $file->getClientOriginalName();
             /*Moving the file to images folder*/
             $file->move('images',$name);
             /*Adding photo to the database*/
             $photo = Photo::create(['file' => $name]);
             Session::flash('photo_created',"Image has been successfully created");
             return redirect()->route('media.index');
        }
        //return redirect()->route('media.index');
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
        $photoToBeDeleted = Photo::findOrFail($id);
        if($photoToBeDeleted != null){
            /*Checking if file exists in the folder*/
            if(\file_exists(public_path().$photoToBeDeleted->file)){
                /*Deleting image from the image folder*/
                unlink(public_path().$photoToBeDeleted->file);
                /*Deleting image from the folder*/
                $photoToBeDeleted->delete();
                /*Session Message*/
                Session::flash('photo_deleted','Image has been successfully deleted');
            }
        }
        return redirect()->route('media.index');
    }
    /*For deleting bulk media*/
    public function deleteBulkMedia(Request $request){
        if(count($request->checkboxArray) > 1){
            $photos = Photo::findOrFail($request->checkboxArray);
            if($photos != null){
                foreach($photos as $key => $photo){
                    if(\file_exists(public_path().$photo->file)){
                        /*Deleting image from the image folder*/
                        unlink(public_path().$photo->file);
                    }
                    $photo->delete();
                }
                Session::flash('bulk_photo_deleted',($key+1).' selected image has been successfully deleted');
            }
        }
        return redirect()->route('media.index');
    }//function ends
}//class ends
