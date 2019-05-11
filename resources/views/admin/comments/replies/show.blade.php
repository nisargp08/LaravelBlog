@extends('layouts.sidebar')
@section('pageContent')
@if(Session::has('reply_status'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('reply_status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(Session::has('reply_deleted'))
  <div class="alert alert-dismissible alert-success fade show">
    {{ session('reply_deleted')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<h2 class="headingTag">Reply : Post - {{ str_limit($post->title,70) }}</h2><hr>
<button role="button" class="btn btn-dark addButtonAdminPanel" onclick="window.location='{{ route('comments.index') }}'">Go Back</button>
    @if(count($replies) > 0)
        <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">#CommentID</th>
                    <th scope="col">Comment</th>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Reply</th>
                    <th scope="col">Status</th>
                    <th scope="col">CreatedAt</th>
                    <th scope="col">UpdatedAt</th>
                    <th scope="col">Operations</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($replies as $key => $reply)
                        <tr>
                            <th scope="row">{{$reply->id}}</th>
                            <td>{{$reply->comment->post_id}}</td>
                            <td>{{$reply->comment->body}}</td>
                            <td>{{$reply->user->name}}</td>
                            <td>{{$reply->user->email}}</td>
                            <td>{{str_limit($reply->body,70)}}</td>
                                @if($reply->is_active == 1)
                                <td class="green-dot"><i class="fas fa-circle"></i></td>
                                @else
                                <td class="red-dot"><i class="fas fa-circle"></i></td>
                                @endif
                            @if ($reply->created_at == null)
                            <td>{{$reply->created_at}}</td>
                            @else
                            <td>{{$reply->created_at->diffForHumans()}}</td>
                            @endif

                            @if ($reply->updated_at == null)
                            <td>{{$reply->updated_at}}</td>
                            @else
                            <td>{{$reply->updated_at->diffForHumans()}}</td>
                            @endif
                            <td>
                                <a href="{{route('blogposts.show',$reply->comment->post_id)}}" class="fas fa-eye icon-pad" title="View Post"></a>
                                <a class="fas fa-user-check icon-pad" data-toggle="modal" data-target="#exampleModal<?php echo $key?>" title="Approve/Unapprove Reply"></a>
                                <a class="fas fa-trash icon-pad" data-toggle="modal" data-target="#deleteModal<?php echo $key?>" title="Delete Reply"></a>
                            </td>
                        </tr>
                        <!-- Modal for approving/unapproving user reply-->
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
                                    Are you sure you want to approve reply - <b>{{ str_limit($reply->body,100) }}</b>?<br><br>
                                    <h5>Current Status - <b>{{ $reply->is_active == 0 ? 'Unapproved' : 'Approved' }}</b></h5>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                {!! Form::open(['method' => 'PATCH','action'=> ['CommentRepliesController@update',$reply->id]]) !!}
                                    {!! Form::hidden('is_active',0)  !!}
                                    {!! Form::submit('Unapprove Reply', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'PATCH','action'=> ['CommentRepliesController@update',$reply->id]]) !!}
                                    {!! Form::hidden('is_active',1)  !!}
                                    {!! Form::submit('Approve Reply', ['class' => 'btn btn-success']) !!}
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
                                    Are you sure you want to delete reply - <b>{{ str_limit($reply->body,100) }}</b>?<br><br>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                {!! Form::open(['method' => 'DELETE','action'=> ['CommentRepliesController@destroy',$reply->id]]) !!}
                                    {!! Form::submit('Delete Reply', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="NoDataMessage">
                    <h2><b>No Replies for the selected comment to show!!</b></h2>
                </div>
            </tbody>
        </table>
    @endif
@endsection
