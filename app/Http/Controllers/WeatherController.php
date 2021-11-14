<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Http;

class WeatherController extends Controller
{
    public $weatherData;
    // public function index()
    // {
    //     return view('login', ['title' => 'login Page']);
    // }
    public function getCurrentWeather()
    {
        $apikey = 'd7c03bc351cb38c5cd2d8b660d9945f0';

        $location = 'Detroit';
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$apikey}&units=imperial");
        //dd($response->json());
        $weatherData = $response;
        return $response;
    }

    public function getWeather($city)
    {
        $apikey = 'd7c03bc351cb38c5cd2d8b660d9945f0';
        $loc = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apikey}");

        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$loc['coord']['lat']}&lon={$loc['coord']['lon']}&exclude={part}&appid={$apikey}&units=imperial");
        return $response;
    }
}
