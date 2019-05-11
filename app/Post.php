<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //Using slug for pretty url : Displaying post title instead of id
    use Sluggable;
    //Using this to use function like findbyslug,findbyslugorfail,etc in controller
    use SluggableScopeHelpers;
     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=> true,
            ]
        ];
    }
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
    public function category(){
        return $this->belongsTo('App\Category');
    }
    /*Inverse one-to-one relationship with model photo(i.e One post can only have one user meaning author)*/
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
    /*One to many relationship wiht comment model(i.e One post can have many comments)*/
    public function comment(){
        return $this->hasMany('App\Comment');
    }
}
