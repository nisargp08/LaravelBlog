<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Schema;

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
        //Getting all the column name for the table user
        $user_fields = $this->filterTableColumns('users');
        return view('admin.users.index',compact('users','user_fields'));
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
    /*Function fetches all the column names for the passed table filters them my removing '_' and capitalizing each word*/
    public function filterTableColumns($table){
        $filteredTable = Schema::getColumnListing($table);
        //Capitalizing everyword of the array
        $filteredTable = array_map('ucfirst',$filteredTable);
        //Replacing '_' in the column name with ' ' in the array
        $filteredTable = str_replace(array('_'),array(' '),$filteredTable);

        return $filteredTable;
    }
}
