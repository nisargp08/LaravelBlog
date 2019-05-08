@extends('layouts.sidebar')
@section('pageContent')
@if(Session::has('category_created'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('category_created')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('category_updated'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('category_updated')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('category_deleted'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('category_deleted')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('category_exists'))
  <div class="alert alert-dismissible alert-danger fade show">
    {{ session('category_exists')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<h2 class="headingTag">Categories </h2><hr>
@if(count($categories) > 0)
<div class="row">
    <div class="col-md-4">
        {!! Form::open(['method' => 'POST','action'=>'AdminCategoriesController@store']) !!}
            <div class="form-group">
                {!! Form::label('name','Category Name:') !!}
                {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::submit('Create Category',['class' => 'form-control btn btn-dark']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-8">
        <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">CreatedAt</th>
                    <th scope="col">UpdatedAt</th>
                    <th scope="col">Operations</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            @if ($category->created_at == null)
                            <td>{{$category->created_at}}</td>
                            @else
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            @endif

                            @if ($category->updated_at == null)
                            <td>{{$category->updated_at}}</td>
                            @else
                            <td>{{$category->updated_at->diffForHumans()}}</td>
                            @endif
                            <td>
                                <a href="{{route('categories.edit',$category->id)}}" class="fas fa-user-edit icon-pad"></a>
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
                                    <div class="col textAlignment">
                                    Are you sure you want to delete category - <b>{{ $category->name }}</b>?
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                {!! Form::open(['method' => 'DELETE','action'=> ['AdminCategoriesController@destroy',$category->id]]) !!}
                                    {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
@else
<div class="NoDataMessage">
        <h2><b>No Categories to Show!!</b></h2>
    </div>
@endif
@include('layouts.messages')
@endsection
