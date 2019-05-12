@extends('layouts.app')
@section('header-styles')
    <link rel="stylesheet" href="{{ asset('css/commentBox.css') }}">
@endsection
@section('content')
<br>
<div class="container">
    <div class="page-header">
        <hr>
        <h3 class="headingTag"><b>Blog Post - </b></h3>
        <button role="button" class="btn btn-dark addButtonAdminPanel" onclick="window.location='{{ route('blogposts.index') }}'">Go Back</button>
        <hr>
    </div>
    <div class="blog-title">
        <h1>{{$post->title}}</h1>
    </div>
    <div class="row blog-margin">
        <div class="col-md-1">
            <img alt="" src="{{$post->user->photo ? $post->user->photo->file : '/images/placeholder.png'}}" class="post-author-photo">
        </div>
        <div class="col-md-9">
            <div class="grid-row"><b>{{ $post->user->name }}</b></div>
            <div class="grid-row">
                <b>{{ $post->created_at ? $post->created_at->toFormattedDateString() : 'Date unavailable'}} - <div class="tag"> {{$post->category->name }}</div></b>
            </div>
        </div>
    </div>
    <div class="blogimage-margin">
        <img src="{{ $post->photo ? $post->photo->file : '/images/placeholder_blog.png'}}" class="img-fluid rounded" alt="Blog Image">
    </div>
    <div class="blog-content">
        <p>{!! $post->body !!}</p>
    </div>
    <div class="tag"><b>{{$post->category->name }}<b></div><hr>
</div>
@endsection
@section('responses')
    <div class="responses">
        <div class="container"><br><br>
            <h3><b>Responses</b></h3>
            <hr>
            @if(Session::has('comment_submitted'))
            <div class="alert alert-dismissible alert-success fade show">
                {{ session('comment_submitted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(Auth::check())
            <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                    <div class="comment-main-level">
                        <!-- Avatar -->
                        <div class="comment-avatar">
                            <img src="{{ Auth::user()->photo_id ? Auth::user()->photo->file : '/images/placeholder.png' }}" alt="">
                        </div>
                        <!-- Comment Box -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name">{{ Auth::user()->name }}</h6>
                            </div>
                            <div class="comment-content">
                                @if(Auth::user()->checkRole() == 'Admin')
                                {!! Form::open(['method' => 'POST','action'=>'PostCommentsController@store']) !!}
                                    {!! Form::hidden('post_id',$post->id) !!}
                                    <div class="form-group">
                                    {!! Form::textarea('body',null,['placeholder' => 'What are your thoughts?','class' => 'form-control','rows' => 3, 'required']) !!}
                                    </div>
                                    {!! Form::submit('Submit Comment', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close()!!}
                                <div class="display-error">@include('layouts.messages')</div>
                                @elseif(Auth::check())
                                {!! Form::open(['method' => 'POST','action'=>'PostCommentsController@createComment']) !!}
                                    {!! Form::hidden('post_id',$post->id) !!}
                                    <div class="form-group">
                                    {!! Form::textarea('body',null,['placeholder' => 'What are your thoughts?','class' => 'form-control','rows' => 3, 'required']) !!}
                                    </div>
                                    {!! Form::submit('Submit Comment', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close()!!}
                                @endif
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
            <hr>
            @else
            <p>Login/Register to comment on the post...</p><hr>
            @endif

            <!-- Loading discus comment plugin -->
            <!--<div id="disqus_thread"></div>
            <script>

            /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            /*(function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://laraveleducation.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();*/
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>-->

            <!-- Displaying all the comments and its reply-->
            <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                    @foreach ($comments as $key => $comment)
                        @if($comment->is_active == 1)
                            <li>
                                <div class="comment-main-level">
                                    <!-- Avatar -->
                                    <div class="comment-avatar">
                                        <img src="{{$comment->user->photo_id ? $comment->user->photo->file : '/images/placeholder.png'}}" alt="">
                                    </div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name {{ $comment->user_id == $comment->post->user_id ? 'by-author' : ''}}">{{ $comment->user->name }}</h6>
                                            <span>{{ $comment->created_at ? $comment->created_at->diffForHumans() : 'Date unavailable'}}</span>
                                                <i data-index="{{ $key }}" class="fa fa-reply replyToggle"></i>
                                            <!--<i class="fa fa-heart"></i>-->
                                        </div>
                                        <div class="comment-content">
                                            {{ $comment->body }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                                <!-- Replies for the comment -->
                                <ul class="comments-list reply-list ">
                                    <!-- Put foreach here after ul-->
                                    @if(count($comment->replies) > 0)
                                        @foreach($comment->replies as $reply)
                                            @if($reply->is_active == 1)
                                                <li>
                                                    <!-- Avatar -->
                                                    <div class="comment-avatar">
                                                            <img src="{{ $reply->user->photo_id ? $reply->user->photo->file : '/images/placeholder.png'}}" alt="">
                                                    </div>
                                                    <div class="comment-box">
                                                        <div class="comment-head">
                                                            <h6 class="comment-name {{ $reply->user->id == $post->user_id ? 'by-author' : '' }}">{{ $reply->user->name }}</h6>
                                                            <span>{{ $reply->created_at ? $reply->created_at->diffForHumans() : 'Date unavailable'}}</span>
                                                             <!--<i class="fa fa-reply"></i>-->
                                                            <!--<i class="fa fa-heart"></i>-->
                                                        </div>
                                                        <div class="comment-content">
                                                            {{ $reply->body }}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if(Auth::check())
                                    <div class="comment-reply-container" id="{{ $key }}">
                                        <li>
                                            <!-- Avatar -->
                                            <div class="comment-avatar">
                                                    <img src="{{ Auth::user()->photo_id ? Auth::user()->photo->file : '/images/placeholder.png' }}" alt="">
                                            </div>
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6 class="comment-name">{{ Auth::user()->name }}</h6>
                                                </div>
                                                <div class="comment-content">
                                                    {!! Form::open(['method' => 'POST','action'=>'CommentRepliesController@createReply']) !!}
                                                        {!! Form::hidden('comment_id',$comment->id) !!}
                                                        <div class="form-group">
                                                        {!! Form::textarea('body',null,['placeholder' => 'What are your thoughts?','class' => 'form-control','rows' => 3, 'required']) !!}
                                                        </div>
                                                        {!! Form::submit('Submit Reply', ['class' => 'btn btn-primary']) !!}
                                                    {!! Form::close()!!}
                                                    <div class="display-error">@include('layouts.messages')</div>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                    @endif
                                    <!-- ends foreach here before ul -->
                                </ul>
                                <!-- Reply section for a comment ends -->
                            </li>
                        @endif
                    @endforeach
                </ul><hr>
            </div> <!--Comments-Container ends --><br>
        </div><!-- container division tag ends -->
    </div><!-- responses division tag ends -->
@endsection
