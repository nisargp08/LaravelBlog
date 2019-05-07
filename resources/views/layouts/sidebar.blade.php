@extends('layouts.app')
@section('content')    
<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                      <b>{{ config('app.name') }}</b>
                    </a>
                </li>
                <li>
                    <a href="/admin">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">Users</a>
                </li>
                <li>
                    <a href="{{route('posts.index')}}">Posts</a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">Categories</a>
                </li>
                <li>
                    <a href="{{route('media.index')}}">Media</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                @yield('pageContent')
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
@endsection