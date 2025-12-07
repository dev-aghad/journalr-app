@extends('layouts.journalrapp')

@section('title', $user->name . "'s Profile")

@section('content')
    <p><b>{{ $user->name }}</b></p>

    <img src="{{ asset('storage/profile_pictures/default.jpg') }}"
     alt="Profile Picture"
     style="max-width:150px;">

    @if ($user->profile && $user->profile->bio)
        <p><b>Bio:</b> {{ $user->profile->bio }}</p>
    @endif

    <hr>

    <p><b>Posts: {{ $user->name }}</b></p>

    @if ($user->posts->count() == 0)
        <p>This user has no posts yet.</p>
    @else
        <ul>
            @foreach ($user->posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif

    <p><b>Comments: {{ $user->name }}</b></p>

    @if ($user->comments->isEmpty())
        <p>This user has not written any comments yet.</p>
    @else
        <ul>
            @foreach ($user->comments as $comment)
                <li style="margin-bottom: 8px;">
                    <b>On post:</b>

                    <a href="{{ route('posts.show', $comment->post) }}">
                        {{ $comment->post->title }}
                    </a>

                    <br>

                    <b>Comment:</b>
                    {{ $comment->body }}
    
                    <br>

                    <p>{{ $post->likes->count() }} likes</p>

                    <br>
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="{{ route('posts.index') }}">Back to All Posts</a></p>
@endsection