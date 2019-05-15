@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-header">
        <hr>
        <h3 class="headingTag"><b>Blog Posts </b></h3>
        <hr>
    </div>
    @if(count($posts) > 0)
    <div class="blog-card-row">
        @foreach ($posts as $post)
        <a class="blog-redirection-to-single" href="{{ route('blogposts.show',$post->slug) }}">
            <div class="blog-card">
                <img class="card-img-top" src="{{ $post->photo_id ? $post->photo->file : '/images/placeholder_blog.png' }}" alt="Photo unavailable">
                <div class="card-body">
                    <div class="card-text card-text-font">{{ str_limit($post->title,70) }}</div>
                </div><hr class="card-hr">
                <div class="card-date">{{ $post->created_at ? $post->created_at->toFormattedDateString() : 'Date Unavailable' }}</div>
                <div class="card-author">By {{ $post->user_id ? $post->user->name : 'Anonymous' }}</div>
            </div>
        </a>
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
