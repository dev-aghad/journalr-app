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