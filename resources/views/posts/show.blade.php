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
        <p>{{$post->body}}</p>
    </div>
    <div class="tag"><b>{{$post->category->name }}<b></div><hr>
</div>
@endsection
@section('responses')
    <div class="responses">
            <div class="container"><br><br>
                <h3><b>Responses</b></h3><hr>
                <!-- Contenedor Principal -->
                <div class="comments-container">
                    <ul id="comments-list" class="comments-list">
                        <li>
                            <div class="comment-main-level">
                                <!-- Avatar -->
                                <div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""></div>
                                <!-- Contenedor del Comentario -->
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name by-author">Agustin Ortiz</h6>
                                        <span>hace 20 minutos</span>
                                        <i class="fa fa-reply"></i>
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <div class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                    </div>
                                </div>
                            </div>
                            <!-- Respuestas de los comentarios -->
                            <ul class="comments-list reply-list">
                                <li>
                                    <!-- Avatar -->
                                    <div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt=""></div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name">Lorena Rojero</h6>
                                            <span>hace 10 minutos</span>
                                            <i class="fa fa-reply"></i>
                                            <i class="fa fa-heart"></i>
                                        </div>
                                        <div class="comment-content">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <!-- Avatar -->
                                    <div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""></div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name by-author">Agustin Ortiz</h6>
                                            <span>hace 10 minutos</span>
                                            <i class="fa fa-reply"></i>
                                            <i class="fa fa-heart"></i>
                                        </div>
                                        <div class="comment-content">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <div class="comment-main-level">
                                <!-- Avatar -->
                                <div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt=""></div>
                                <!-- Contenedor del Comentario -->
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name">Lorena Rojero</h6>
                                        <span>hace 10 minutos</span>
                                        <i class="fa fa-reply"></i>
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <div class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
@endsection
