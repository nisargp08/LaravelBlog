@extends('layouts.sidebar')
@section('pageContent')
<h2>Users</h2>
<table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">RoleId</th>
            <th scope="col">IsActive</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">EmailVerifiedAt</th>
            <th scope="col">CreatedAt</th>
            <th scope="col">UpdatedAt</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>    
                <td>{{$user->role_id}}</td>
                <td>{{$user->is_active}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->email_verified_at}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td> 
            </tr>
            @endforeach
        </tbody>
      </table>
@endsection