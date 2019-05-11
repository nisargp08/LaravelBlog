@extends('layouts.sidebar')
@section('pageContent')
@if(Session::has('comment_status'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('comment_status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<h2 class="headingTag">Comments : Post - {{ str_limit($post->title,70) }}</h2><hr>
<button role="button" class="btn btn-dark addButtonAdminPanel" onclick="window.location='{{ route('comments.index') }}'">Go Back</button>

    @if(count($comments) > 0)
    <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">#PostID</th>
                <th scope="col">Post-Title</th>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Comment</th>
                <th scope="col">Status</th>
                <th scope="col">CreatedAt</th>
                <th scope="col">UpdatedAt</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>
                @foreach($comments as $key => $comment)
                <tr>
                    <th scope="row">{{$comment->id}}</th>
                    <td>{{$comment->post_id}}</td>
                    <td>{{ $comment->post->title}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->user->email}}</td>
                    <td>{{str_limit($comment->body,70)}}</td>
                        @if($comment->is_active == 1)
                        <td class="green-dot"><i class="fas fa-circle"></i></td>
                        @else
                        <td class="red-dot"><i class="fas fa-circle"></i></td>
                        @endif
                    @if ($comment->created_at == null)
                    <td>{{$comment->created_at}}</td>
                    @else
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    @endif

                    @if ($comment->updated_at == null)
                    <td>{{$comment->updated_at}}</td>
                    @else
                    <td>{{$comment->updated_at->diffForHumans()}}</td>
                    @endif
                    <td>
                        <a href="{{route('blogposts.show',$post->slug)}}" class="fas fa-eye icon-pad" title="View Post"></a>
                        <a class="fas fa-user-check icon-pad" data-toggle="modal" data-target="#exampleModal<?php echo $key?>" title="Approve/Unapprove Comment"></a>
                        <a class="fas fa-trash icon-pad" data-toggle="modal" data-target="#deleteModal<?php echo $key?>" title="Delete Comment"></a>

                    </td>
                </tr>
                 <!-- Modal for approving/unapproving user comment-->
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
                                Are you sure you want to approve comment - <b>{{ str_limit($comment->body,100) }}</b>?<br><br>
                                <h5>Current Status - <b>{{ $comment->is_active == 0 ? 'Unapproved' : 'Approved' }}</b></h5>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            {!! Form::open(['method' => 'PATCH','action'=> ['PostCommentsController@update',$comment->id]]) !!}
                                {!! Form::hidden('is_active',0)  !!}
                                {!! Form::submit('Unapprove Comment', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            {!! Form::open(['method' => 'PATCH','action'=> ['PostCommentsController@update',$comment->id]]) !!}
                                {!! Form::hidden('is_active',1)  !!}
                                {!! Form::submit('Approve Comment', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Modal for deleting user comment-->
                 <div class="modal fade" id="deleteModal<?php echo $key?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Action!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col textAlignment">
                                Are you sure you want to delete comment - <b>{{ str_limit($comment->body,100) }}</b>?<br><br>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE','action'=> ['PostCommentsController@destroy',$comment->id]]) !!}
                                {!! Form::submit('Delete Comment', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="NoDataMessage">
                        <h2><b>No Comments to Show!!</b></h2>
                    </div>
            </tbody>
        </table>
    @endif
@endsection
