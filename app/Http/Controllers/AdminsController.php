<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\CommentReply;
use App\Category;
use App\Photo;

class AdminsController extends Controller
{
    //
    public function index(){
        $postCount = Post::count();
        $userCount = User::count();
        $commentCount = Comment::count();
        $replyCount = CommentReply::count();
        $categoryCount = Category::count();
        $photoCount = Photo::count();

        return view('admin.index',compact('postCount','userCount','commentCount','replyCount','categoryCount','photoCount'));
    }
}
