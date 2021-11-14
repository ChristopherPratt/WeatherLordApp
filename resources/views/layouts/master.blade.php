


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Lord</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >

</head>
<body class="text-white">
    <header class="fixed  top-0 left-0 right-0 z-50">
        <div class="container mx-auto flex justify-between p-4 h-16">
            <a href="/home" class="text-xl font-black hover:text-green-500 transition">Weather Lord</a>
            <nav class="-mx-2">               
                @if (Auth::id())
                    <a href="/dashboard" class="text-lg mx-2 text-white hover:text-green-500 transition">{{Auth::user()->name}}</a>
                    <a href="/logout" class="text-lg mx-2 text-white hover:text-green-500 transition">Logout</a>
                @else
                    <a href="/login" class="text-lg mx-2 text-white hover:text-green-500 transition">Login</a>
                @endif
                <a href="/home" class="text-lg mx-2 text-white hover:text-green-500 transition">Home</a>
                <a href="/about" class="text-lg mx-2 text-white hover:text-green-500 transition">About</a>                

            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>

    <footer>
        <header class="container bg-gray-700 mx-auto p-4 z-50">
            <p>&copy; Chris Pratt | Weather Lord</p>
        </header>
    </footer>


</body>
</html>