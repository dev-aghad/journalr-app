@extends('layouts.journalrapp')

@section('title', 'Post information')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-600">
                Posted by
                <a href="{{ route('profile.show', $post->user) }}"
                   class="text-indigo-600 hover:underline">
                    {{ $post->user->name }}
                </a>
            </p>
            <h2 class="text-2xl font-semibold text-gray-900 mt-1">
                {{ $post->title }}
            </h2>
        </div>

        @auth
            @if (auth()->id() === $post->user_id || auth()->user()->isAdmin())
                <div class="flex items-center space-x-2">
                    <a href="{{ route('posts.edit', $post) }}"
                       class="px-3 py-1 text-xs bg-yellow-500 text-grey rounded hover:bg-yellow-600">
                        Edit
                    </a>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                          onsubmit="return confirm('Delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </div>

    @if ($post->image_path)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $post->image_path) }}"
                 alt="Post Image"
                 class="mb-2 rounded shadow max-h-80 object-cover">
        </div>
    @endif

    <div class="mb-4">
        <p class="text-gray-800 whitespace-pre-line">
            {{ $post->body }}
        </p>
    </div>

    @if ($post->tags->count())
        <div class="mb-4">
            <span class="font-semibold text-sm text-gray-700">Tags:</span>
            <div class="mt-1 flex flex-wrap gap-2">
                @foreach ($post->tags as $tag)
                    <a href="{{ route('posts.index', ['tag' => $tag->id]) }}"
                       class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full hover:bg-indigo-200">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="mb-6 flex items-center space-x-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-700">
            Likes: <span class="ml-1 font-semibold">{{ $post->likes->count() }}</span>
        </span>

        @auth
            @if ($post->isLikedBy(auth()->user()))
                <form action="{{ route('like.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300">
                        Unlike
                    </button>
                </form>
            @else
                <form action="{{ route('like.store', $post) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-3 py-1 text-xs bg-indigo-600 text-grey rounded hover:bg-indigo-700">
                        Like
                    </button>
                </form>
            @endif
        @else
            <p class="text-xs text-gray-600">
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a> to like this post.
            </p>
        @endauth
    </div>

    <h3 class="text-lg font-semibold mb-3">Comments</h3>

    @auth
        <form id="comment-form" method="POST" action="{{ route('comments.store', $post) }}"
              class="mb-4 space-y-2">
            @csrf
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">
                    Add a comment:
                </label>
                <textarea name="body" id="body" rows="3"
                          class="mt-1 w-full border border-gray-300 rounded px-3 py-2 text-sm
                                 focus:ring-indigo-500 focus:border-indigo-500">{{ old('body') }}</textarea>
            </div>
            <button type="submit"
                    class="block mb-6 !bg-gray-600 text-grey rounded-lg p-4 text-center shadow hover:bg-gray-100 cursor-pointer transition">
                Post Comment
            </button>
        </form>
    @else
        <p class="mb-4 text-sm text-gray-600">
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a> to comment.
        </p>
    @endauth

    <div id="comments-list" class="space-y-3">
        @foreach ($post->comments as $comment)
            <div class="border border-gray-200 rounded-md p-3">
                <p class="text-sm text-gray-600 mb-1">
                    <a href="{{ route('profile.show', $comment->user) }}"
                       class="font-semibold hover:underline">
                        {{ $comment->user->name }}
                    </a>
                    replied
                </p>

                <p class="text-sm text-gray-800 mb-2">
                    {{ $comment->body }}
                </p>

                <div class="flex items-center space-x-3 text-xs text-gray-600">
                    <span>Likes: <span class="font-semibold">{{ $comment->likes->count() }}</span></span>

                    @auth
                        @if ($comment->isLikedBy(auth()->user()))
                            <form action="{{ route('comments.unlike', $comment) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">
                                    Unlike
                                </button>
                            </form>
                        @else
                            <form action="{{ route('comments.like', $comment) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="px-2 py-1 bg-indigo-600 text-grey rounded hover:bg-indigo-700">
                                    Like
                                </button>
                            </form>
                        @endif

                        @if (auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        <a href="{{ route('posts.index') }}" class="text-sm text-indigo-600 hover:underline">
            Back to All Posts
        </a>
    </div>

@endsection