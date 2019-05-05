@extends('layouts.sidebar')
@section('pageContent')
<h2>User - <b>{{ $user->name}}</b></h2>
<hr>
    <button role="button" class="btn btn-dark" onclick="window.location='{{ URL::route('users.index')}}'">Go Back</button>
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
                                <th>Status : </th>
                                @if($user->is_active == 1)
                                    <td class="green-dot"><i class="fas fa-circle"></i></td>
                                @else
                                    <td class="red-dot"><i class="fas fa-circle"></i></td>
                                @endif
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
        </div>
    </div>
</div>
@endsection