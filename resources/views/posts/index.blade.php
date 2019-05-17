@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-header">
        <hr>
        <h3 class="headingTag"><b>Blog Posts </b></h3>
        <hr>
    </div>
    @if(Session::has('post_deleted'))
    <div class="alert alert-dismissible alert-success fade show">
      {{ session('post_deleted')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(Session::has('post_saved'))
    <div class="alert alert-dismissible alert-success fade show">
      {{ session('post_saved')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(count($posts) > 0)
    <div class="blog-card-row">
        @foreach ($posts as $key => $post)
        <a class="blog-redirection-to-single" href="{{ route('blogposts.show',$post->slug) }}">
            <div class="blog-card">
                <table class="card-container">
                <tr>
                    <td valign="top">
                        <img class="card-img-top" src="{{ $post->photo_id ? $post->photo->file : '/images/placeholder_blog.png' }}" alt="Photo unavailable">
                        <div class="card-body">
                            <div class="card-text card-text-font">{{ str_limit($post->title,70) }}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="bottom">
                        <hr class="card-hr">
                        <div class="row">
                            <div class="col-md-8 card-details">
                                <div class="card-date">{{ $post->created_at ? $post->created_at->toFormattedDateString() : 'Date Unavailable' }}</div>
                                <div class="card-author">By {{ $post->user_id ? $post->user->name : 'Anonymous' }}</div>
                            </div>
                            @if(Auth::check() && $post->user_id == Auth::user()->id)
                                <div class="col-md-4 icon-details">
                                    <a title="Edit Post" href="{{ route('userposts.edit',$post->id) }}"><i class="fas fa-edit operation-icon"></i></a>
                                    <a title="Save Post" href="/usersposts/{{ $post->id }}/save"><i class="fas fa-bookmark operation-icon"></i></a>
                                    <a title="Delete Post" data-toggle="modal" data-target="#exampleModal<?php echo $key?>"  href="{{ route('userposts.destroy',$post->id) }}"><i class="fas fa-trash operation-icon"></i></a>
                                </div>
                            @else
                                <div class="col-md-4 save-icon-details">
                                    <a title="Save Post" href="/usersposts/{{ $post->id }}/save"><i class="fas fa-bookmark operation-icon"></i></a>
                                </div>
                            @endif

                        </div>
                    </td>
                </tr>
                </table>
            </div>
        </a>
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
                    {!! Form::open(['method' => 'DELETE','action'=> ['UserPostsController@destroy',$post->id]]) !!}
                        {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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
</div>
@endsection
@section('footer-scripts')
@endsection
