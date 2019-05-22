<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Photo;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        return view('usersprofile.index',compact('user'));
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
        $user = User::findOrFail($id);
        return view('usersprofile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if(trim($request->password) == ''){
            $userInput = $request->except('password');
        }
        else{
            $userInput = $request->all();
            /*Encrypting the data*/
            $userInput['password'] = bcrypt($request->password);
        }
        if($file = $request->file('photo_id')){
            /*Deleting Previous Image - Condition : If user has a previously uploaded photo*/
            if(!is_null($user['photo_id'])){
                if(\file_exists(public_path().$user->photo->file)){
                /*Deleting image from the 'images' folder*/
                unlink(public_path().$user->photo->file);
                }
                /*Deleting image from the photos table*/
                $user->photo->delete();
            }
            /*Saving the new uploaded image to the database*/
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=> $name]);
            $userInput['photo_id'] = $photo->id;
        }
        $user->update($userInput);
        Session::flash('user_updated','User "'.$user->name.'" has been successfully updated.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userToDelete = User::findOrFail($id);
        /*Will only delete the image if user actually uploaded the photo : Using this will eliminate the need to store the placeholder image in the database to avoid 'Trying to get property of non-object' error*/
        if(!is_null($userToDelete['photo_id'])){
            if(\file_exists(public_path().$userToDelete->photo->file)){
                /*Deleting image from the 'images' folder*/
                unlink(public_path().$userToDelete->photo->file);
            }
            /*Deleting image from the photos table*/
            $userToDelete->photo->delete();
        }
        Session::flash('user_deleted','User "'.$userToDelete->name.'" has been successfully deleted.');
        $userToDelete->delete();
        return redirect('/');
    }
}
