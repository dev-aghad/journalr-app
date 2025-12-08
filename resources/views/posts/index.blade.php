@extends('layouts.journalrapp')

@section('title', 'Posts')

@section('content')
    <p><a href="{{ route('posts.create') }}">Create New Post</a></p>
    <p>All Current Posts:</p>

    <form method="GET" action="{{ route('posts.index') }}">
        <label for="tag">Filter by tag:</label>

        <select name="tag" id="tag" onchange="this.form.submit()">
            <option value="">All Tags</option>

            @foreach ($tags as $t)
                <option value="{{ $t->id }}" {{ $tag == $t->id ? 'selected' : '' }}>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>

        <noscript>
            <button type="submit">Filter</button>
        </noscript>
    </form>

    <ul>
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post) }}">
            <li>{{ $post->title }}</li>
            </a>
        @endforeach
    </ul>

    <div class="mt-4 text-xs">
        {{ $posts->links() }}
    </div>
@endsection