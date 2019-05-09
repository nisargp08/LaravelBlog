@extends('layouts.app')
@section('header-styles')
    <link rel="stylesheet" href="{{ asset('css/commentBox.css') }}">
@endsection
@section('content')
<br>
<div class="container">
    <div class="page-header">
        <hr>
        <h3 class="headingTag"><b>Blog Post - </b></h3>
        <button role="button" class="btn btn-dark addButtonAdminPanel" onclick="window.location='{{ route('blogposts.index') }}'">Go Back</button>
        <hr>
    </div>
    <div class="blog-title">
        <h1>{{$post->title}}</h1>
    </div>
    <div class="row blog-margin">
        <div class="col-md-1">
            <img alt="" src="{{$post->user->photo ? $post->user->photo->file : '/images/placeholder.png'}}" class="post-author-photo">
        </div>
        <div class="col-md-9">
            <div class="grid-row"><b>{{ $post->user->name }}</b></div>
            <div class="grid-row">
                <b>{{ $post->created_at ? $post->created_at->toFormattedDateString() : 'Date unavailable'}} - <div class="tag"> {{$post->category->name }}</div></b>
            </div>
        </div>
    </div>
    <div class="blogimage-margin">
        <img src="{{ $post->photo ? $post->photo->file : '/images/placeholder_blog.png'}}" class="img-fluid rounded" alt="Blog Image">
    </div>
    <div class="blog-content">
        <p>{{$post->body}}</p>
    </div>
    <div class="tag"><b>{{$post->category->name }}<b></div><hr>
</div>
@endsection
@section('responses')
    <div class="responses">
        <div class="container"><br><br>
            <h3><b>Responses</b></h3>
            <hr>
            @if(Session::has('comment_submitted'))
            <div class="alert alert-dismissible alert-success fade show">
                {{ session('comment_submitted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(Auth::user())
            <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                    <div class="comment-main-level">
                        <!-- Avatar -->
                        <div class="comment-avatar">
                            <img src="{{ Auth::user()->photo_id ? Auth::user()->photo->file : '/images/placeholder.png' }}" alt="">
                        </div>
                        <!-- Comment Box -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name">{{ Auth::user()->name }}</h6>
                            </div>
                            <div class="comment-content">
                                {!! Form::open(['method' => 'POST','action'=>'PostCommentsController@store']) !!}
                                    {!! Form::hidden('post_id',$post->id) !!}
                                    <div class="form-group">
                                    {!! Form::textarea('body',null,['placeholder' => 'What are your thoughts?','class' => 'form-control','rows' => 3, 'required']) !!}
                                    </div>
                                    {!! Form::submit('Submit Comment', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close()!!}
                                <div class="display-error">@include('layouts.messages')</div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
            <hr>
            @else
            <p>Login/Register to comment on the post...</p><hr>
            @endif
            <!-- Displaying all the comments and its reply-->
            <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                    @foreach ($comments as $comment)
                        <li>
                            <div class="comment-main-level">
                            <!-- Avatar -->
                            <div class="comment-avatar"><img src="{{$comment->user->photo_id ? $comment->user->photo->file : '/images/placeholder.jpg'}}" alt=""></div>
                                <!-- Contenedor del Comentario -->
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name {{ $comment->user_id == $comment->post->user_id ? 'by-author' : ''}}">{{ $comment->user->name }}</h6>
                                        <span>{{ $comment->created_at ? $comment->created_at->diffForHumans() : 'Date unavailable'}}</span>
                                        <i class="fa fa-reply"></i>
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <div class="comment-content">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                            <!-- Replies for the comment -->
                            <ul class="comments-list reply-list">
                                <!-- Put foreach here after ul-->
                                <li>
                                    <!-- Avatar -->
                                    <div class="comment-avatar">
                                        <img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt="">
                                    </div>
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name"><a href="http://creaticode.com/blog">Lorena Rojero</a></h6>
                                            <span>hace 10 minutos</span>
                                            <i class="fa fa-reply"></i>
                                            <i class="fa fa-heart"></i>
                                        </div>
                                        <div class="comment-content">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                        </div>
                                    </div>
                                </li>
                                <!-- ends foreach here before ul -->
                            </ul>
                            <!-- Reply section for a comment ends -->
                        </li>
                    @endforeach
                </ul>
            </div> <!--Comments-Container ends -->
        </div><!-- container division tag ends -->
    </div><!-- responses division tag ends -->
@endsection
