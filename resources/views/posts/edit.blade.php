@extends('layouts.journalrapp')

@section('title', 'Edit Post')

@section('content')

    <p class="mb-4 text-gray-700 font-medium">Edit Post</p>

    <form method="POST" action="{{ route('posts.update', $post) }}" 
          enctype="multipart/form-data"
          class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Title
            </label>
            <input type="text" name="title"
                   value="{{ old('title', $post->title) }}"
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
                             focus:ring-indigo-500 focus:border-indigo-500">{{ old('body', $post->body) }}</textarea>
        </div>

        @if ($post->image_path)
            <div>
                <p class="block text-sm font-medium text-gray-700 mb-1">
                    Current Image
                </p>
                <img src="{{ asset('storage/' . $post->image_path) }}"
                     alt="Current Post Image"
                     class="mb-2 max-h-40 rounded border">
            </div>
        @endif

        <br>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Replace Image (optional)
            </label>
            <input type="file" name="image"
                   class="block w-full text-sm text-gray-700">
        </div>

        <br>

        <div>
            <p class="block text-sm font-medium text-gray-700 mb-1">
                Edit Tags:
            </p>

            <div class="flex flex-wrap gap-3">
                @foreach ($tags as $tag)
                    <label class="inline-flex items-center text-sm text-gray-700">
                        <input 
                            type="checkbox" 
                            name="tags[]" 
                            value="{{ $tag->id }}"
                            class="mr-2 rounded border-gray-300"
                            {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <br>

        <div class="flex items-center space-x-4">
            <button type="submit"
                    class="block mb-6 !bg-gray-600 text-grey rounded-lg p-4 
                    text-center shadow hover:bg-gray-100 cursor-pointer transition">
                Update Post
            </button>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('posts.show', $post) }}"
               class="text-sm text-indigo-600 hover:underline">
                Cancel
            </a>
        </div>


    </form>
@endsection