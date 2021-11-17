@inject('dashboard', 'App\Http\Controllers\DashboardController')

@extends('layouts.master')

@section('content')
<article class="bg-gradient-to-t from-gray-500 to-gray-800 min-h-screen">
        <section class="pl-4 pt-16">
                <h1 class="text-4xl text-center pb-8">{{ $title }}</h1>
                <h2 class="text-lg mt-3">How To Use:</h2>
                <p>click on the trash can icon to remove weather location.</p>
                <p>click on save icon to save weather location (must be logged in).</p>
                <h3 class="text-lg mt-3">Technologies Used:</h3>
                <p>This weather web site has been made to impress APAX Software members.</p>
                <p>Technologies used: Larevel, Tailwindcss, OpenWeatherMap, mapbox and sqlite.</p>


        </section>
        
</article>
        
@endsection