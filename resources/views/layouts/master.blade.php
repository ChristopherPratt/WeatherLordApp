


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
        <div class="mx-auto flex justify-between p-4 h-16">
            <a href="/" class="text-xl font-black hover:text-green-500 transition whitespace-nowrap">Weather Lord</a>
            <nav class="-mx-2 whitespace-nowrap">               
                @if (Auth::id())
                    <a href="/dashboard" class="text-lg mr-1 text-white hover:text-green-500 transition">{{Auth::user()->name}}</a>
                    <a href="/logout" class="text-lg mr-1 text-white hover:text-green-500 transition">Logout</a>
                @else
                    <a href="/login" class="text-lg mr-1 text-white hover:text-green-500 transition">Login</a>
                @endif                
                <a href="/about" class="text-lg mr-1 text-white hover:text-green-500 transition">About</a>                

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