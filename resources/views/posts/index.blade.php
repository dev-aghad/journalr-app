@extends('layouts.journalrapp')

@section('title', 'Posts')

@section('content')
    <p><a href="{{ route('posts.create') }}">Create New Post</a></p>
    <p>All Current Posts:</p>
    <ul>
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post) }}">
            <li>{{ $post->title }}</li>
            </a>
        @endforeach
    </ul>
@endsection