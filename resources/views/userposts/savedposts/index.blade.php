@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-header">
        <hr>
        <a title="Published posts" href="{{ route('userposts.index') }}"><h3 class="headingTag"><b>My Blog Posts </b></h3></a>
        <h3 class="headingTag"><b> | </b></h3>
        <a title="Saved posts" href="/userposts/savedposts"><h3 class="headingTag"><b>Saved Posts </b></h3></a>
        <hr>
    </div>
    @if(Session::has('post_saved'))
        <div class="alert alert-dismissible alert-success fade show">
          {{ session('post_saved')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif
    @if(Session::has('unsaved_post'))
    <div class="alert alert-dismissible alert-success fade show">
      {{ session('unsaved_post')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(count($savedPosts) > 0)
    <div class="blog-card-row">
        @foreach ($savedPosts as $key => $savedpost)
            <a class="blog-redirection-to-single" href="{{ route('blogposts.show',$savedpost->post->slug) }}">
                    <div class="blog-card">
                        <table class="card-container">
                            <tr>
                                <td valign="top">
                                    <img class="card-img-top" src="{{ $savedpost->post->photo_id ? $savedpost->post->photo->file : '/images/placeholder_blog.png' }}" alt="Photo unavailable" />
                                    <div class="card-body">
                                        <div class="card-text card-text-font">{{ str_limit($savedpost->post->title,70) }}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom">
                                    <hr class="card-hr">
                                    <div class="row">
                                        <div class="col-md-8 card-details">
                                                <div class="card-date">{{ $savedpost->post->created_at ? $savedpost->post->created_at->toFormattedDateString() : 'Date Unavailable' }}</div>
                                                <div class="card-author">By {{ $savedpost->post->user_id ? $savedpost->post->user->name : 'Anonymous' }}</div>
                                        </div>
                                        <div class="col-md-4 save-icon-details">
                                                <a title="Unsave Post" href="/usersposts/{{ $savedpost->post->id }}/unsave"><i class="fas fa-bookmark operation-icon"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
        @endforeach
    </div>
    <!-- Pagination -->
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-center"> {{ $savedPosts->links() }}</div>
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
