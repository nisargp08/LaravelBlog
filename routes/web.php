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
/*Admin Routes - Users*/
Route::resource('/admin/users','AdminUserController');
Route::get('/admin',function(){
    return view('admin.index');
});