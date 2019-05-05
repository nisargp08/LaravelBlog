@extends('layouts.sidebar')
@section('pageContent')
<h2>Create Post</h2>
<hr>
<button type="button" onclick="window.location='{{ URL::route('posts.index') }}'" class="btn btn-dark">Go Back</button>
<hr>
{!! Form::open(['method' => 'POST','action' => 'AdminPostsController@store','files' => true]) !!}
    <div class="form-group">
        {!! Form::label('title','Post Title:') !!}
        {!! Form::text('title',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
            {!! Form::label('body','Post Content:') !!}
            {!! Form::textarea('body',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('category_id','Post Category : ') !!}
        {!! Form::select('category_id',array('' => 'Choose a category')+$categories,null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group upload-btn-wrapper">
            <b>{!! Form::label('photo_id','Post Image:') !!}</b>
            <button class="fileBtn">Upload a file</button>
            {!! Form::file('photo_id',array('onchange' => 'readURL(this)')) !!}<br><br>
            <img src="" id="profile-img-tag" class="img-fluid rounded imgDimension"/>
    </div>
    <div class="form-group">
        {!! Form::submit('Create Post',['class' => 'btn btn-success']) !!}
    </div>
    
@include('layouts.messages')
{!! Form::close() !!}
@endsection