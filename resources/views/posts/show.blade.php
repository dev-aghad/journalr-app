@extends('layouts.journalrapp')

@section('title')
    Post information
@endsection

@section('content')
    <ul>
        <li>Posted by: {{ $post->user->name }}</li>
        <li>Title: {{ $post->title }}</li>
        <li>Body: {{ $post->body }}</li>
    </ul>

    <p>
        @auth
        @if (auth()->id() === $post->user_id)
        <a href="{{ route('posts.edit', $post) }}">
            Edit Post
        </a>
        @endif
        @endauth
    </p>
    
    <p>
        @auth
        @if (auth()->id() === $post->user_id)
            <form action="{{ route('posts.destroy', $post) }}" method="POST" 
                onsubmit="return confirm('Delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Post</button>
            </form>
        @endif
        @endauth
    </p>

    <p></p>

    <p><a href="{{ route('posts.index') }}">Back to All Posts</a></p>    
@endsection