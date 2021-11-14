@inject('weather', 'App\Http\Controllers\WeatherController')
@extends('layouts.master')

@section('content')
<article class="bg-gradient-to-t from-gray-500 to-gray-800 min-h-screen  ">

        <section class="flex ">
                <header>

                </header>
                <input type="text">
                
        </section>

        <section class="overflow-x-auto pt-32 mx-2 text-center">
                <div class="w-max m-auto bg-gray-900 text-white text-sm rounded-lg  flex ">                  
                        <section class="current-weather flex items-center justify-between pl-4">
                                <div>
                                        <div class=" font-semibold text-center">Current Weather</div>
                                        <header class="flex items-center justify-between">
                                                <header class="">
                                                        <div class="text-5xl font-semibold ">{{round($currentWeather['current']['temp'])}} &#176;F</div>
                                                        <div class="text-gray-400">Feels like {{round($currentWeather['current']['feels_like'])}} &#176;F</div>
                                                </header>
                                                <header class="">
                                                        <img class="text-center w-40 -my-10" src="http://openweathermap.org/img/wn/{{$currentWeather['current']['weather'][0]['icon']}}@4x.png">                                                        
                                                        <div class="font-semibold text-center ">{{$currentWeather['current']['weather'][0]['description']}}</div>
                                                </header>
                                        </header>
                                        <div class="text-gray-400 text-center">{{$city2}}</div> 
                                </div>
                        </section>
                        @foreach ($currentWeather['daily'] as $weather)
                                <section class="future-weather bg-gray-800 rounded-lg mr-2  my-2 px-1 py-1">
                                        <header class="">
                                                
                                                @if ( $weather['dt'] == $currentWeather['daily'][0]['dt'])
                                                        <p class="text-center">Today</p>  
                                                @else
                                                        <p class="text-center">{{ strtoupper(\Carbon\Carbon::createFromTimestamp($weather['dt'])->format('D'))}}</p>                                                                                      
                                                @endif
                                                <img class="text-center -my-5 " src="http://openweathermap.org/img/wn/{{$weather['weather'][0]['icon']}}@2x.png">
                                                <p class="text-center">{{$weather['weather'][0]['description']}}</p>
                                                <p class="text-center text-red-500">{{round($weather['temp']['max'])}} &#176;F</p>
                                                <p class="text-center text-blue-500">{{round($weather['temp']['min'])}} &#176;F</p>
                                        </header>
                                </section>
                        @endforeach
                </div>
        </section>

</article>
@endsection