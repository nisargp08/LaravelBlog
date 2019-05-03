@extends('layouts.sidebar')
@section('pageContent')
<h2 class="headingTag">Users</h2>
<table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Name</th>
            <th scope="col">Profile Image</th>
            <th scope="col">Email</th>
            <th scope="col">EmailVerifiedAt</th>
            <th scope="col">CreatedAt</th>
            <th scope="col">UpdatedAt</th>
            <th scope="col">Operations</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <th scope="row">{{$user->id}}</th>    
                <td>{{$user->role['name']}}</td>
                @if($user->is_active == 1)
                <td class="green-dot"><i class="fas fa-circle"></i></td>
                @else
                <td class="red-dot"><i class="fas fa-circle"></i></td>
                @endif
                <td>{{$user->name}}</td>
                <td><img alt="" src="{{$user->photo ? $user->photo->file : '/images/placeholder.png'}}" class="indexImgDimension"></td>
                <td>{{$user->email}}</td>
                @if ($user->email_verified_at == null)
                <td>{{$user->email_verified_at}}</td>
                @else
                <td>{{$user->email_verified_at->diffForHumans()}}</td>
                @endif

                @if ($user->created_at == null)
                <td>{{$user->created_at}}</td>
                @else
                <td>{{$user->created_at->diffForHumans()}}</td>
                @endif

                @if ($user->updated_at == null)
                <td>{{$user->updated_at}}</td>
                @else
                <td>{{$user->updated_at->diffForHumans()}}</td>
                @endif
                <td>
                  <a href="{{route('users.edit',$user->id)}}" class="fas fa-eye icon-pad"></a>
                  <a href="{{route('users.edit',$user->id)}}" class="fas fa-user-edit icon-pad"></a>
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
                        <div class="col imgAlignment">
                            <img alt="" src="{{$user->photo ? $user->photo->file : '/images/placeholder.png'}}" class="indexImgDimension">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col textAlignment">
                          Are you sure you want to delete user - <b>{{ $user->name }}</b>?
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                      {!! Form::open(['method' => 'DELETE','action'=> ['AdminUserController@destroy',$user->id]]) !!}
                        {!! Form::submit('Confirm', ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </tbody>
      </table>
@endsection