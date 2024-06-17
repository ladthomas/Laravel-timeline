<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-bold text-gray-800 dark:text-gray-200">Timeline App</a>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="text-blue-500 dark:text-blue-400">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 text-blue-500 dark:text-blue-400">Register</a>
                @else
                    <span class="text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="ml-4 text-red-500 dark:text-red-400"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
