@extends('layouts.journalrapp')

@section('title', $user->name . "'s Profile")

@section('content')
    <div class="flex items-center space-x-8 mb-6">
        <img src="{{ asset('storage/profile_pictures/default.jpg') }}"
             alt="Profile Picture"
             class="w-20 h-20 rounded-full object-cover border border-gray-300">

        <div>
            <p class="text-xl font-semibold text-gray-900">
                {{ $user->name }}
            </p>

            <p class="text-sm text-gray-600 mt-1">
                <span class="font-semibold">Account Type:</span>
                @if ($user->role === 'admin')
                    Administrator
                @else
                    User
                @endif
            </p>

            @if ($user->profile && $user->profile->bio)
                <p class="mt-2 text-sm text-gray-800">
                    <span class="font-semibold">Bio:</span>
                    {{ $user->profile->bio }}
                </p>
            @else
                <p class="mt-2 text-sm text-gray-500 italic">
                    No bio set yet.
                </p>
            @endif
        </div>
    </div>

    <hr class="mb-6">

    <div class="mb-8">
        <p class="text-lg font-semibold text-gray-900 mb-2">
            Posts by {{ $user->name }}
        </p>

        @if ($user->posts->count() == 0)
            <p class="text-sm text-gray-600">This user has no posts yet.</p>
        @else
            <ul class="space-y-3">
                @foreach ($user->posts as $post)
                    <li class="border border-gray-200 rounded-md p-3 bg-gray-50">
                        <a href="{{ route('posts.show', $post) }}"
                           class="text-sm font-medium text-indigo-700 hover:underline">
                            {{ $post->title }}
                        </a>

                        <p class="text-xs text-gray-600 mt-1">
                            {{ $post->likes->count() }} likes
                        </p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mb-6">
        <p class="text-lg font-semibold text-gray-900 mb-2">
            Comments by {{ $user->name }}
        </p>

        @if ($user->comments->isEmpty())
            <p class="text-sm text-gray-600">This user has not written any comments yet.</p>
        @else
            <ul class="space-y-3">
                @foreach ($user->comments as $comment)
                    <li class="border border-gray-200 rounded-md p-3 bg-white">
                        <p class="text-xs text-gray-600 mb-1">
                            <span class="font-semibold">On post:</span>
                            <a href="{{ route('posts.show', $comment->post) }}"
                               class="text-indigo-700 hover:underline">
                                {{ $comment->post->title }}
                            </a>
                        </p>

                        <p class="text-sm text-gray-800">
                            <span class="font-semibold">Comment:</span>
                            {{ $comment->body }}
                        </p>

                        <p class="text-xs text-gray-600 mt-1">
                            {{ $comment->likes->count() }} likes
                        </p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <p>
        <a href="{{ route('posts.index') }}"
           class="text-sm text-indigo-600 hover:underline">
            Back to All Posts
        </a>
    </p>
@endsection