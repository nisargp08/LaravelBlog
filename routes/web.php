<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Authentication Routes*/
Auth::routes();
/*Application Routes*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/blogposts','PostsController');
/*Grouping all the admin routes under 'Admin' middleware*/
Route::group(['middleware' => 'Admin'],function(){
    /*Dashboard Route*/
    Route::get('/admin',function(){
        return view('admin.index');
    });
    /*Routes for user management on admin panel*/
    Route::resource('/admin/users','AdminUserController');
    /*Rotues for posts management on admin panel*/
    Route::resource('/admin/posts','AdminPostsController');
    /*Routes for categories management on admin panel*/
    Route::resource('/admin/categories','AdminCategoriesController');
    /*Routes for media management on admin panel*/
    Route::resource('/admin/media','AdminMediaController');
    /*Routes for comments management on admin panel*/
    Route::resource('/admin/comments','PostCommentsController');
    /*Routes for comments replies management on admin panel*/
    Route::resource('/admin/comments/replies','CommentRepliesController');

});
