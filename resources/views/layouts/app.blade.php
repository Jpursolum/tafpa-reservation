<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAFPA Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-lg font-semibold text-orange-500">TAFPA</a>

            @auth
                <div>
                    <span class="mr-2">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Logout</button>
                    </form>
                </div>
            @else
                <div>
                    <a href="{{ route('filament.auth.login') }}" class="text-blue-500 hover:underline mr-2">Login</a>
                    <a href="{{ route('filament.auth.register') }}" class="text-blue-500 hover:underline">Register</a>
                </div>
            @endauth
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
