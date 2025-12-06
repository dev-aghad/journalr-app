@extends('layouts.journalrapp')

@section('title', 'Create a New Post')

@section('content')
    <p>Creating a post:</p>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Post Title: <input type="text" name="title"
            value="{{ old('title') }}"></p>
        <p>Content: <input type="text" name="body"
            value="{{ old('body') }}"></p>
        <p><input type="submit" name="Create Post"></p>
        <a href="{{ route('posts.index') }}">Back to All Posts</a>
    </form>
@endsection