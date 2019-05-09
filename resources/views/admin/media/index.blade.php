@extends('layouts.sidebar')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
@endsection
@section('pageContent')
@if(Session::has('photo_created'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('photo_created')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('photo_updated'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('photo_updated')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('photo_deleted'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('photo_deleted')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<h2 class="headingTag">Media </h2><hr>
@if(count($media) > 0)
<div class="row">
    <div class="col">
        {!! Form::open(['method' => 'POST','action'=>'AdminMediaController@store','class'=>'dropzone','files' => 'true']) !!}
            <div class="dz-message" data-dz-message>
                <span><h4>Drop files here to upload or Click here to browse !!</h4><b>Maximum upload allowed(2MB)</b></span>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<br>
<div class="row">
    <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">CreatedAt</th>
                <th scope="col">UpdatedAt</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>
                @foreach($media as $key => $image)
                    <tr>
                        <th scope="row">{{$image->id}}</th>
                        <td>{{$image->file}}</td>
                        <td><img alt="" src="{{$image->file}}" class="indexImgDimension"></td>
                        @if ($image->created_at == null)
                        <td>{{$image->created_at}}</td>
                        @else
                        <td>{{$image->created_at->diffForHumans()}}</td>
                        @endif

                        @if ($image->updated_at == null)
                        <td>{{$image->updated_at}}</td>
                        @else
                        <td>{{$image->updated_at->diffForHumans()}}</td>
                        @endif
                        <td>
                            <a class="fas fa-trash icon-pad" data-toggle="modal" data-target="#exampleModal<?php echo $key?>"></a>
                        </td>
                    </tr>
                    <!-- Modal for deleting user confirmation-->
                    <div class="modal fade" id="exampleModal<?php echo $key?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Action!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col imgAlignment">
                                        <img alt="" src="{{$image->file ? $image->file : '/images/placeholder.png'}}" class="indexImgDimension">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col textAlignment">
                                        Are you sure you want to delete image?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            {!! Form::open(['method' => 'DELETE','action'=> ['AdminMediaController@destroy',$image->id]]) !!}
                                {!! Form::submit('Delete Image', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
    </table>
</div>
@else
<div class="NoDataMessage">
        <h2><b>No Media to Show!!</b></h2>
    </div>
@endif
@include('layouts.messages')
@endsection
@section('scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection
