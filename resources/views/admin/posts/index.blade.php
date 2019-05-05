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
<h2 class="headingTag">Posts - </h2>
<button role="button" class="btn btn-dark addButtonAdminPanel" onclick="window.location='{{ route('posts.create') }}'">Add Posts</button>
@if(count($posts) > 0)
    <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
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
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>  
                        <td><img alt="" src="{{$post->photo ? $post->photo->file : '/images/placeholder.png'}}" class="indexImgDimension"></td>
                        <td>{{$post->user->name}}</td>
                        <td></td>
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
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
    </table>
@else
    <div class="NoDataMessage">
        <h2><b>No Posts to Show!!</b></h2>
    </div>
@endif
@endsection