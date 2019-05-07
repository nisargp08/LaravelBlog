<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
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
        $allCategory = Category::all();
        $category = $this->validate(
            $request,
            /*Validation request*/
            [
            'name' => 'required',
            ],
            /*Custom error message*/
            [
            'name.required' => 'Category name is required',
            ]
    );
        foreach($allCategory as $singleCategory){
            /*Checking if category already exists and if it does returns an error*/
            if(strcasecmp($singleCategory->name,$category['name']) == 0){
                /*User input category already exists so returning without saving it to database*/
                Session::flash('category_exists','Category "'.$category['name'].'" already exists');
                return redirect()->route('categories.index');
            }
        }
        $cat = Category::create($category);
        Session::flash('category_created','Category "'.$cat->name.'" has been successfully added');
        return redirect()->route('categories.index');
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
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
        $validatedData = $this->validate(
            $request,[
                'name' => 'required',
            ],
            [
                'name.required' => 'Category field cannot be empty',
            ]
        );
        $category = Category::findOrFail($id);
        $category->update($validatedData);
        Session::flash('category_updated','Category "'.$category->name.'" has been successfully updated');
        return redirect()->route('categories.index');

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
        $categoryToBeDeleted = Category::findOrFail($id);
        Session::flash('category_deleted','Category "'.$categoryToBeDeleted->name.'" has been successfully deleted');
        $categoryToBeDeleted->delete();
        return redirect()->route('categories.index');
    }
}
