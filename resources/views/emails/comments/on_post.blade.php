<x-mail::message>
# New Comment!

Hello {{ $post->user->name }},

Your post "{{ $post->title }}" received a new comment from {{ $comment->user->name }}:

"{{ $comment->body }}"

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
