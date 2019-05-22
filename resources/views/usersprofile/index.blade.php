@extends('layouts.app')
@section('content')
<div class="container container-margin">
    @if(Session::has('user_updated'))
    <div class="alert alert-dismissible alert-success fade show">
        {{ session('user_updated')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <h2>My Profile</h2>
    <hr>
    <button type="button" onclick="window.location='{{ URL::route('user.index') }}'" class="btn btn-dark">Go Back</button>
    <hr>
    <div class="row">
        <div class="col-md-2">
                <img src="{{$user->photo ? $user->photo->file : '/images/placeholder.png'}}" id="profile-img-tag" class="img-fluid rounded"/>
        </div>
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header"><b>{{$user->name}}'s Information</b></h5>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                                <tr>
                                <th>Name : </th>
                                <td>{{$user->name}}</td>
                                </tr>
                                <th>Email : </th>
                                <td>{{$user->email}}</td>
                            </tr>
                                <th>Role : </th>
                                <td>{{$user->role->name}}</td>
                            </tr>
                                <th>Created At : </th>
                                @if ($user->created_at == null)
                                    <td>{{$user->created_at}}</td>
                                    @else
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                @endif
                            </tr>
                                <th>Last Updated At : </th>
                                @if ($user->updated_at == null)
                                    <td>{{$user->updated_at}}</td>
                                    @else
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                @endif
                            </tr>
                    </table>
                </div>
            </div><br>
            <a class="btn btn-success" href="{{route('user.edit',$user->id)}}" style="color:white;">Update Profile</a>
            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete Account</button>
                <!-- Modal for deleting user confirmation-->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            {!! Form::open(['method' => 'DELETE','action'=> ['UserProfileController@destroy',$user->id]]) !!}
                            {!! Form::submit('Delete User', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
