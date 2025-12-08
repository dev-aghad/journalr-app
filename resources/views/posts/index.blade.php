@extends('layouts.journalrapp')

@section('title', 'Posts')

@section('content')
    @auth
        <a href="{{ route('posts.create') }}"
            class="block mb-6 !bg-gray-600 text-grey 
            rounded-lg p-4 text-center shadow hover:bg-gray-100 cursor-pointer transition">
                Create New Post
        </a>
    @endauth

    <h2 class="text-lg font-semibold mb-4">All Current Posts:</h2>

    <form method="GET" action="{{ route('posts.index') }}"
          class="mb-6 flex items-center space-x-3">

        <label for="tag" class="text-gray-700 font-medium">Filter by tag:</label>

        <select name="tag" id="tag" onchange="this.form.submit()"
                class="border border-gray-300 rounded px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">All Tags</option>

            @foreach ($tags as $t)
                <option value="{{ $t->id }}" {{ $tag == $t->id ? 'selected' : '' }}>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>

        <noscript>
            <button class="px-3 py-1 bg-gray-700 text-grey rounded">Apply</button>
        </noscript>
    </form>

    <ul class="space-y-3">
        @foreach ($posts as $post)
            <li class="bg-white p-4 rounded shadow hover:shadow-md transition">
                <a href="{{ route('posts.show', $post) }}"
                   class="text-lg font-semibold text-indigo-600 hover:underline">
                    {{ $post->title }}
                </a>

                <p class="text-sm text-gray-600 mt-1">
                    by 
                    <a href="{{ route('profile.show', $post->user) }}" 
                       class="text-indigo-500 hover:underline">
                        {{ $post->user->name }}
                    </a>
                </p>

                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach ($post->tags as $tagItem)
                        <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded">
                            {{ $tagItem->name }}
                        </span>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-6 pagination text-xs">
        {{ $posts->links() }}
    </div>

@endsection