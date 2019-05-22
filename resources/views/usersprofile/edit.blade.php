@extends('layouts.app')
@section('content')
<div class="container container-margin">
    <h2>Edit User</h2>
    <hr>
    <button type="button" onclick="window.location='{{ URL::route('user.index') }}'" class="btn btn-dark">Go Back</button>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <img src="{{$user->photo ? $user->photo->file : '/images/placeholder.png'}}" id="profile-img-tag" class="img-fluid rounded"/>
        </div>
        <div class="col-md-10">
                {!! Form::model($user,['method' => 'PATCH','action'=> ['UserProfileController@update',$user->id],'files'=> true]) !!}

                <div class="form-group">
                    <b>{!! Form::label('name','Name:') !!}</b>
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <b>{!! Form::label('email','Email:') !!}</b>
                    {!! Form::email('email',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                        <b>{!! Form::label('password','Password:') !!}</b>
                        {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
                <div class="form-group upload-btn-wrapper">
                        <b>{!! Form::label('photo_id','Profile Image:') !!}</b>
                        <button class="fileBtn">Upload a file</button>
                        {!! Form::file('photo_id',array('onchange' => 'readURL(this)'),['class' => 'profile-img']) !!}<br>
                </div>
                <div class="form-group">
                    {!! Form::submit('Update User',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::hidden('user_id',$user->id) !!}
            {!! Form::close() !!}
        </div>
    </div>
    @include('layouts.messages')
</div>
@endsection
