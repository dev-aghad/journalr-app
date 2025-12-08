@extends('layouts.journalrapp')

@section('title', 'Create a New Post')

@section('content')
    @if(isset($quote))
        <div class="p-4 mb-4 bg-gray-100 border rounded">
            <b>Daily Quote:</b>
            <p>{{ $quote }}</p>
        </div>
    @endif

    <p>Creating a post:</p>
    <form method="POST" action="{{ route('posts.store') }}" 
        enctype="multipart/form-data">
            @csrf
            <p>Post Title: <input type="text" name="title"
                value="{{ old('title') }}"></p>
            <p>Content: <input type="text" name="body"
                value="{{ old('body') }}"></p>
            <p><input type="file" name="image"></p>
            <p>Select Tags:</p>

            @foreach ($tags as $tag)
                <label style="margin-right: 10px;">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                {{ $tag->name }}
                </label>
            @endforeach

            <p><input type="submit" name="Create Post"></p>
            <a href="{{ route('posts.index') }}">Back to All Posts</a>
    </form>
@endsection