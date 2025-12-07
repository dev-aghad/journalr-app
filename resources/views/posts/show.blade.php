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

    <p>Likes: {{ $post->likes->count() }}</p>

    <p>
        @auth
            @if ($post->isLikedBy(auth()->user()))
                <form action="{{ route('like.destroy', $post) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Unlike</button>
                </form>
            @else
                <form action="{{ route('like.store', $post) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">Like</button>
                </form>
            @endif
        @else
            <p><a href="{{ route('login') }}">Log in</a> to like this post.</p>
        @endauth
    </p>

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
        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" 
                alt="Post Image" 
                class="mb-4 rounded shadow">
        @endif
        @endauth
    </p>

    <p>Comments:</p>

    @auth
        <form method="POST" action="{{ route('comments.store', $post) }}">
            @csrf
            <p>
                <label for="body">Add a comment:</label><br>
                <textarea name="body" id="body">{{ old('body') }}</textarea>
            </p>
            <button type="submit">Post Comment</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Log in</a> to comment.</p>
    @endauth

    @foreach ($post->comments as $comment)
        <div style="margin-top: 10px; border-top: 1px solid #ccc; padding-top: 5px;">
            <p>
                <b>{{ $comment->user->name }}</b> replied:
            </p>
            <p>{{ $comment->body }}</p>

            <p>Likes: {{ $comment->likes->count() }}</p>

            @auth
                @if ($comment->isLikedBy(auth()->user()))
                    <form action="{{ route('comments.unlike', $comment) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unlike</button>
                    </form>
                @else
                    <form action="{{ route('comments.like', $comment) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit">Like</button>
                    </form>
                @endif

                @if (auth()->id() === $comment->user_id)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this comment?');">
                            Delete
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach


    <p><a href="{{ route('posts.index') }}">Back to All Posts</a></p>    
@endsection