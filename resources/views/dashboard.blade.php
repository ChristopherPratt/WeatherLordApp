@inject('dashboard', 'App\Http\Controllers\DashboardController')
@inject('weather', 'App\Http\Controllers\WeatherController')

@extends('layouts.master')

@section('content')
<article class="bg-gradient-to-t from-gray-500 to-gray-800 min-h-screen  ">
        
        <form action="/addLocation" method="GET">
                @csrf
                <section class="flex  items-center justify-center w-full mx-auto pt-24">                
                        <label for="location" class="text-m whitespace-nowrap ml-3 mt-2 align-middle">New Location:</label>
                        <input type="text" id='location' name="location" placeholder="Enter City and State" class="bg-gray-900 min-w-0  w-96  ml-2 mr-2 rounded-lg" autofocus>         
                        <button type="submit" class="bg-gray-900  px-2 mr-16 rounded-lg">Add</button> 
                </section>
                <div class="flex justify-center my-3">
                        <label for="message" class="text-red-500 text-base  w-max text-center ">{{$weatherLocations[1]}} </label>
                </div>
        </form>
        @foreach($weatherLocations[0] as $index => $currentWeather)
                <section class="overflow-x-auto pb-2 mx-2 text-center">
                        <div class="w-max m-auto bg-gray-900 text-white text-sm rounded-lg  flex ">                  
                                <section class="current-weather flex items-center justify-between pl-4">
                                                
                                        <div>
                                                <div class="flex">
                                                        <form action="/removeLocation" method="GET">
                                                                @csrf
                                                                <section class="">                                                                
                                                                        <input type="text" id='remove' name="remove" value={{$index}} class="hidden">         
                                                                        <button type="submit" class=" ">&#128465;</button> 
                                                                </section>
                                                        </form>
                                                        <div class=" font-semibold text-center w-full mr-2 ">Current Weather</div>     
                                                </div>
                                                <header class="flex items-center justify-between">
                                                        <header class="">
                                                                <div class="text-5xl font-semibold ">{{round($currentWeather['current']['temp'])}} &#176;F</div>
                                                                <div class="text-gray-400">Feels like {{round($currentWeather['current']['feels_like'])}} &#176;F</div>
                                                        </header>
                                                        <header class="">
                                                                <img class="text-center w-40 -my-10" src="http://openweathermap.org/img/wn/{{$currentWeather['current']['weather'][0]['icon']}}@4x.png">                                                        
                                                                <div class="font-semibold text-center  ">{{$currentWeather['current']['weather'][0]['description']}}</div>
                                                        </header>
                                                </header>
                                                <div class="flex">
                                                        <form action="/saveLocation" method="GET">
                                                                        @csrf
                                                                        <section class="">                                                                
                                                                                <input type="text" id='save' name="save" value={{$index++}} class="hidden">         
                                                                                <button type="submit" class=" ">&#128190;</button> 
                                                                        </section>
                                                                </form>
                                                        <div class="text-gray-400 text-center w-full mr-2">{{$currentWeather['name']}}</div> 
                                                </div>
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
        @endforeach

</article>
@endsection