@extends('layouts.sidebar')
@section('pageContent')
<h2>Edit Category</h2>
<hr>
<button type="button" onclick="window.location='{{ URL::route('categories.index') }}'" class="btn btn-dark">Go Back</button>
<hr>
    {!! Form::model($category,['method' => 'PATCH','action'=> ['AdminCategoriesController@update',$category->id]]) !!}
    <div class="form-group">
        {!! Form::label('name','Category Title:') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update Category',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@include('layouts.messages')
@endsection