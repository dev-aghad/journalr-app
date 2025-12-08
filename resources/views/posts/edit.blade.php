@extends('layouts.journalrapp')

@section('title', 'Edit a Post:')

@section('content')
    <p>Edit Post</p>

    <form method="POST" action="{{ route('posts.update', $post) }}" 
        enctype="multipart/form-data">
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

            <p><input type="file" name="image"></p>

            <p>Edit Tags:</p>
            @foreach ($tags as $tag)
                <label style="margin-right: 10px;">
                    <input 
                        type="checkbox" 
                        name="tags[]" 
                        value="{{ $tag->id }}"
                        {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </label>
            @endforeach

            <p>
                <button type="submit">Update Post</button>
            </p>
    </form>
@endsection