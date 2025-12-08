@extends('layouts.journalrapp')

@section('title', 'Create Tag')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Create a New Tag</h2>

    <form method="POST" action="{{ route('tags.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Tag Name:
            </label>
            <input type="text" name="name"
                   value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm
                        focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <br>

        <button type="submit"
                class="block mb-6 !bg-gray-600 text-grey rounded-lg p-4 
                text-center shadow hover:bg-gray-100 cursor-pointer transition">
                Create Tag
        </button>

        <a href="{{ route('posts.index') }}"
            class="text-sm text-indigo-600 hover:underline">
            Cancel
        </a>
    </form>
@endsection