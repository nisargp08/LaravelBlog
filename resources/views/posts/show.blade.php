@extends('layouts.app')
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
            <div class="container">
                <h5><b class="comment-section">Responses</b></h5>
            </div>
    </div>
@endsection