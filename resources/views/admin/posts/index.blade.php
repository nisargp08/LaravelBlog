@extends('layouts.sidebar')
@section('pageContent')
@if(Session::has('post_created'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('post_created')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('post_updated'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('post_updated')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('post_deleted'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('post_deleted')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<h2 class="headingTag">Posts - </h2>
<button role="button" class="btn btn-dark addButtonAdminPanel" onclick="window.location='{{ route('posts.create') }}'">Add Posts</button>
@if(count($posts) > 0)
    <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">CreatedAt</th>
                <th scope="col">UpdatedAt</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td><a title="View Post" class="title-redirect" href="{{route('blogposts.show',$post->slug)}}">{{str_limit($post->title,70)}}</a></td>
                        <td><img alt="" src="{{$post->photo ? $post->photo->file : '/images/placeholder_blog.png'}}" class="indexImgDimension"></td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                        @if ($post->created_at == null)
                        <td>{{$post->created_at}}</td>
                        @else
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        @endif

                        @if ($post->updated_at == null)
                        <td>{{$post->updated_at}}</td>
                        @else
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        @endif
                        <td>
                            <a href="{{route('blogposts.show',$post->slug)}}" class="fas fa-eye icon-pad" title="View Post"></a>
                            <a href="{{route('comments.show',$post->id)}}" class="far fa-comments icon-pad" title="View Post Comments"></a>
                            <a href="{{route('posts.edit',$post->id)}}" class="fas fa-user-edit icon-pad" title="Edit Post"></a>
                            <a class="fas fa-trash icon-pad" data-toggle="modal" data-target="#exampleModal<?php echo $key?>" title="Delete Post"></a>
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
                                    <img alt="" src="{{$post->photo ? $post->photo->file : '/images/placeholder_blog.png'}}" class="indexImgDimension">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col textAlignment">
                                Are you sure you want to delete post - <b>{{ $post->title }}</b>?
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            {!! Form::open(['method' => 'DELETE','action'=> ['AdminPostsController@destroy',$post->id]]) !!}
                                {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
    </table><hr>
    <!-- Pagination links -->
    <!-- Pagination -->
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-center"> {{ $posts->links() }}</div>
        </div>
    </div>
@else
    <div class="NoDataMessage">
        <h2><b>No Posts to Show!!</b></h2>
    </div>
@endif
@endsection
