@extends('layouts.journalrapp')

@section('title', 'Create a New Post')

@section('content')
    @if(isset($quote))
        <div class="p-4 mb-4 bg-gray-100 border rounded">
            <b>Daily Quote:</b>
            <p>{{ $quote }}</p>
        </div>
    @endif

    <p class="mb-4 text-gray-700 font-medium">Creating a post:</p>

    <form method="POST" action="{{ route('posts.store') }}" 
          enctype="multipart/form-data"
          class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Post Title
            </label>
            <input type="text" name="title"
                   value="{{ old('title') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                          focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <br>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Content
            </label>

            <textarea name="body" rows="6"
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm 
                        focus:ring-indigo-500 focus:border-indigo-500"
                required>{{ old('body') }}</textarea>
        </div>

        <br>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Optional Image
            </label>
            <input type="file" name="image"
                   class="block w-full text-sm text-gray-700">
        </div>

        <br>

        <div>
            <p class="block text-sm font-medium text-gray-700 mb-1">
                Select Tags:
            </p>

            <div class="flex flex-wrap gap-4">
                @foreach ($tags as $tag)
                    <label class="inline-flex items-center text-sm text-gray-700">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               class="mr-2 rounded border-gray-300">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <br>

        <div class="flex items-center space-x-4">
            <button type="submit"
                    class="block mb-6 !bg-gray-600 text-grey rounded-lg p-4 text-center shadow hover:bg-gray-100 cursor-pointer transition">
                Create Post
            </button>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('posts.index') }}" 
                class="text-sm text-indigo-600 hover:underline">
                Back to All Posts
            </a>
        </div>
    </form>
@endsection