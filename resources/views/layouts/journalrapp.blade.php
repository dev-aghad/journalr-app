<html>
    <head>
        <title>Journalr App - @yield('title')</title>
    <head>

    <body>
        <h1>Journalr - @yield('title')</h1>

        @auth
            <a href="{{ route('profile.show', auth()->user()) }}">My Profile</a>
        @endauth

        <hr>

        @auth
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button type="submit" class="text-red-500 hover:underline">
                    Logout
                </button>
            </form>
        @endauth

        @if (session('message'))
            <p><b>{{ session('message') }}</b></p>
        @endif

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif    

        <div>
            @yield('content')
        </div>  
    </body>
</html>   