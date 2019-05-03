<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Schema;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Getting all the users data
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role_name = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('role_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }
        else{
            $input = $request->all();
            /*Encrypting password*/
            $input['password'] = bcrypt($request->password);
        }
       if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
       }
       User::create($input);
       Session::flash('user_created','User '.$input['name'].' has been successfully created.');
       return redirect()->route('users.index');
        //return $request->all();
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
        $role = Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','role'));
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
        //
        if(trim($request->password) == ''){
            $userInput = $request->except('password');
        }
        else{
            $userInput = $request->all();
            /*Encrypting password*/
            $userInput['password'] = bcrypt($request->password);
        }
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=> $name]);
            $userInput['photo_id'] = $photo->id;
        }
        $user = User::findOrFail($id);
        $user->update($userInput);
        Session::flash('user_updated','User '.$user->name.' has been successfully updated.');
        return redirect()->route('users.index');
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
        Session::flash('user_deleted','User '.$userToDelete->name.' has been successfully deleted.');
        $userToDelete->delete();
        return redirect()->route('users.index');
    }
}
