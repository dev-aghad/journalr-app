<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            Journalr App - @yield('title')
        </title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100 text-gray-900">
        <div class="min-h-screen">
            <nav class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center space-x-8">
                            <a href="{{ route('posts.index') }}" class="text-lg font-semibold text-gray-900">
                                Journalr
                            </a>
                        </div>

                        <div class="flex items-center space-x-8">
                            <a href="{{ route('posts.index') }}"
                               class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                Posts
                            </a>

                            <a href="{{ route('dashboard') }}"
                                class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                Dashboard
                                </a>

                            @auth
                                <a href="{{ route('profile.show', auth()->user()) }}"
                                    class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                    My Profile
                                </a>

                                <a href="{{ route('logout') }}"
                                    class="text-sm font-medium text-red-600 hover:text-red-800"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                </a>

                                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                    Log in
                                </a>
                                <a href="{{ route('register') }}"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                    Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <main class="py-8">
                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h1 class="text-xl font-semibold text-gray-900">
                                @yield('title')
                            </h1>
                        </div>

                        <div class="px-6 pt-4">
                            @if (session('message'))
                                <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-2 text-sm text-green-800">
                                    <b>{{ session('message') }}</b>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-4 rounded-md bg-red-50 border border-red-200 px-4 py-2 text-sm text-red-800">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="px-6 pb-6">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>