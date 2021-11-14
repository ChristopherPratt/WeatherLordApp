@inject('dashboard', 'App\Http\Controllers\DashboardController')


@extends('layouts.master')

@section('content')
        <!-- <h1>{{ $title }}</h1> -->
        <!-- <p>This is the home page for an example Laravel web application.</p> -->
        <body class="antialiased">

                <div class="relative flex items-center justify-center min-h-screen bg-blue-800">
                 
                <!-- <a href="/logout" class="text-lg mx-2 text-white hover:text-green-500 transition">Logout</a>
                <a href="/logout" class="text-lg mx-2 text-white hover:text-green-500 transition">
                {{ $dashboard::getUserName() }} 
                </a>-->
                <img 
                        src="https://three29.com/wp-content/themes/three29/images/t29-logo-seafoam.svg" 
                        alt="Three29 Logo" 
                        class="h-32 animate-bounce"
                >
                </div>
        </body>
@endsection