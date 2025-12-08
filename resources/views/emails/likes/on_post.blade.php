<x-mail::message>
# New Like!

Hello {{ $post->user->name }},

Your post "{{ $post->title }}" was liked by {{ $like->name }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>