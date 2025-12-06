@extends('layouts.journalrapp')

@section('title', 'Delete an old Post')

@section('content')
    <p>Deleting an old post:</p>
    @auth
        @if (auth()->id() === $post->user_id)
            <a href="{{ route('posts.edit', $post) }}">Edit</a>

            <form method="POST" action="{{ route('posts.destroy', $post) }}" 
                style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
            </form>
        @endif
    @endauth

@endsection