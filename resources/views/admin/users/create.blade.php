@extends('layouts.sidebar')
@section('pageContent')
<h2>Create Users</h2>
<hr>
<button role="button" class="btn btn-dark" onclick="window.location='{{ URL::route('users.index')}}'">Go Back</button>
<hr>
{!! Form::open(['method' => 'POST','action'=> 'AdminUserController@store','files'=> true]) !!}

    <div class="form-group">
        <b>{!! Form::label('name','Name:') !!}</b>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <b>{!! Form::label('email','Email:') !!}</b>
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
            <b>{!! Form::label('role_id','Role:') !!}</b>
            {!! Form::select('role_id',[''=>'Choose a Role'] + $role_name,null,['class'=>'form-control']) !!}
        </div>
    <div class="form-group">
            <b>{!! Form::label('is_active','Status:') !!}</b>
            {!! Form::select('is_active',array(1 => 'Active', 0 => 'Not Active'),0,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
            <b>{!! Form::label('password','Password:') !!}</b>
            {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group upload-btn-wrapper">
            <b>{!! Form::label('photo_id','Profile Image:') !!}</b>
            <button class="fileBtn">Upload a file</button>
            {!! Form::file('photo_id',array('onchange' => 'readURL(this)'),['class' => 'profile-img']) !!}<br><br>
            <img src="" id="profile-img-tag" class="img-fluid rounded imgDimension"/>
    </div>
    <div class="form-group">
        {!! Form::submit('Create User',['class'=>'btn btn-success']) !!}
    </div>
    @include('layouts.messages')
{!! Form::close() !!}
@endsection