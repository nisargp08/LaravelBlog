@extends('layouts.sidebar')
@section('pageContent')
<h2>Edit Post</h2>
<hr>
<button type="button" onclick="window.location='{{ URL::route('posts.index') }}'" class="btn btn-dark">Go Back</button>
<hr>
@endsection