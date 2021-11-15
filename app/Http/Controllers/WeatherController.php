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
        
        $apikey = config('services.openweather.key');
        $openMapToken = config('services.mapbox.token');
        $location = 'Detroit';
        //$response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$apikey}&units=imperial");
        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/Los%20Angeles.json?access_token={$openMapToken}");

        dd($response->json());
        //$weatherData = $response;
        //return $response;
    }

    public function getWeatherFirst($city)
    {
        $apikey = config('services.openweather.key');
        $mapbox = config('services.mapbox.token');
        //$loc = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apikey}");
        $loc = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$city}.json?limit=5&access_token={$mapbox}");
        //dump($loc2->json());
        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$loc['features'][0]['center'][1]}&lon={$loc['features'][0]['center'][0]}&exclude={part}&appid={$apikey}&units=imperial");
        return $response;
    }

    public function getWeather($location)
    {
        $mapbox = config('services.mapbox.token');
        $apikey = config('services.openweather.key');
        
        $loc = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$location}.json?limit=5&access_token={$mapbox}");
        //dd($loc->json());
        if ($loc['message'] == "Not Found" || Count($loc['features']) == 0)
        {
            $loc = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/Lexington.json?limit=5&access_token={$mapbox}");
        }
        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$loc['features'][0]['center'][1]}&lon={$loc['features'][0]['center'][0]}&exclude={part}&appid={$apikey}&units=imperial");
        $city = explode(",",$loc['features'][0]['place_name']);
        if (Count($city) >= 2)
        {
            $name = $city[0] . ',' . $city[1];
        }
        else{
            $name = $city[0];
        }
        //dd($response);
        $Data = json_decode($response, true);
        //dd($Data);
        $Data['name'] = $name;
        $tempData = $Data;

        return $tempData;

    }                                       

    public function resetLocations($lats, $longs, $names)
    {
        $tempData = [];
        $apikey = config('services.openweather.key');
        for ($x = 0; $x < Count($lats); $x++) 
        {

            $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$lats[$x]}&lon={$longs[$x]}&exclude={part}&appid={$apikey}&units=imperial");    
            $newData = json_decode($response, true);
            $newData['name'] = $names[$x];
            if ($x == 0)
            {
                //dd($tempdata);
                $tempData = [$newData];                
            }
            else{
                array_push($tempData, $newData);            
            }
        }
        
        return $tempData;

        
    }
}
