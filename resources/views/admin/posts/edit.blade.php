@extends('layouts.sidebar')
@section('pageContent')
@include('layouts.tinyeditor')
<h2>Edit Post</h2>
<hr>
<button type="button" onclick="window.location='{{ URL::route('posts.index') }}'" class="btn btn-dark">Go Back</button>
<hr>
<div class="row">
    <div class="col-md-2">
        <img src="{{$post->photo ? $post->photo->file : '/images/placeholder_blog.png'}}" id="profile-img-tag" class="img-fluid rounded"/>
    </div>
    <div class="col-md-10">
            {!! Form::model($post,['method' => 'PATCH','action'=> ['AdminPostsController@update',$post->id],'files'=> true]) !!}

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
            {!! Form::select('category_id',$categories,null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group upload-btn-wrapper">
                <b>{!! Form::label('photo_id','Post Image:') !!}</b>
                <button class="fileBtn">Upload a file</button>
                {!! Form::file('photo_id',array('onchange' => 'readURL(this)')) !!}<br><br>
                <img src="" id="profile-img-tag" class="img-fluid rounded imgDimension"/>
        </div>
            <div class="form-group">
                {!! Form::submit('Update Post',['class'=>'btn btn-success']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@include('layouts.messages')
@endsection
