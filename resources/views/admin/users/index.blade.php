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
            @foreach($users as $user)
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
                  <a href="{{route('users.destroy',$user->id)}}" class="fas fa-trash icon-pad"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
@endsection