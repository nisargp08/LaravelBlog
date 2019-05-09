@extends('layouts.sidebar')
@section('pageContent')
<h2 class="headingTag">Comments </h2><hr>
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
                        <a href="{{route('blogposts.show',$comment->post->id)}}" class="fas fa-eye icon-pad"></a>

                    </td>
                </tr>
                @endforeach
                @else
                    <div class="NoDataMessage">
                        <h2><b>No Comments to Show!!</b></h2>
                    </div>
            </tbody>
        </table>
    @endif
@endsection
