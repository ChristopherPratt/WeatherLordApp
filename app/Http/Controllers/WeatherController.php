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

    public function getWeather($city)
    {
        $apikey = config('services.openweather.key');
        $mapbox = config('services.mapbox.token');
        //$loc = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apikey}");
        $loc = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$city}.json?limit=5&access_token={$mapbox}");
        //dump($loc2->json());
        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$loc['features'][0]['center'][1]}&lon={$loc['features'][0]['center'][0]}&exclude={part}&appid={$apikey}&units=imperial");
        return $response;
    }

    public function getLocations(Request $req)
    {
        $mapbox = config('services.mapbox.token');
        $apikey = config('services.openweather.key');
        $data = $req->input()['location'];
        $loc = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$data}.json?limit=5&access_token={$mapbox}");
        //dd($loc->json());
        if (Count($loc['features']) == 0)
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

        $Data = json_decode($response, true);
        $Data['name'] = $name;
        $tempData = collect([$Data]);
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $tempData]);
    }

    public function resetLocations($lats, $longs, $names)
    {
        
        $apikey = config('services.openweather.key');
        for ($x = 0; $x < Couunt($lats); $x++) 
        {
            $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$lats[x]}&lon={$longs[x]}&exclude={part}&appid={$apikey}&units=imperial");    
            $Data = json_decode($response, true);
            $Data['name'] = $names[x];
            if (x == 0)
            {
                $tempData = collect([$response]);                
            }
            else{
                array_push($tempdata, $response);            
            }
        }
        return view('dashboard', 
        ['title' => 'Dashboard'],
        [
        'weatherLocations' => $tempdata]);
        
    }
}
