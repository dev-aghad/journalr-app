@extends('layouts.journalrapp')

@section('title', 'Edit a Post:')

@section('content')
    <p>Edit Post</p>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <p>
            Title:
            <input type="text" name="title" 
                value="{{ old('title', $post->title) }}">
        </p>

        <p>
            Content:
            <input type="text" name="body" 
                value="{{ old('body', $post->body) }}">
        </p>

        <p>
            <button type="submit">Update Post</button>
        </p>
    </form>
@endsection