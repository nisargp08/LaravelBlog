<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'body'
    ];
    /*Inverse one-to-one relationship with user model(i.e One post can only have one user meaning author)*/
    public function user(){
        return $this->belongsTo('App\User');
    }
    /* relationship with user Category(i.e One post can only have one user meaning author)*/
    /*public function category(){
        return $this->belongsToMany('App\Category');
    }
    /*Inverse one-to-one relationship with user photo(i.e One post can only have one user meaning author)*/
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
}
