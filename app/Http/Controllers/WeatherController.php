<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Exceptions\Handler;
use Auth;
use Http;

class WeatherController extends Controller
{
    public $weatherData;

    
    public function getWeatherFirst($city)
    {
        $loc = $this->apiGetLocation($city);
        if ($loc['ErrFlag']) return $loc;
        $response = $this->apiGetWeather($loc['features'][0]['center'][1],$loc['features'][0]['center'][0]);
        if ($response['ErrFlag']) return $response;
        return $response;
    }

    public function getWeather($location)
    {
        $loc = $this->apiGetLocation($location);
        if ($loc['ErrFlag']) return $loc;

        $response = $this->apiGetWeather($loc['features'][0]['center'][1],$loc['features'][0]['center'][0]);
        if ($response['ErrFlag']) return $response;

        $city = explode(",",$loc['features'][0]['place_name']);
        if (Count($city) >= 2)
        {
            $name = $city[0] . ',' . $city[1];
        }
        else{
            $name = $city[0];
        }
        $response['name'] = $name;
        return $response;
    }                                       

    public function resetLocations($lats, $longs, $names)
    {
        $tempData = [];        
        for ($x = 0; $x < Count($lats); $x++) 
        {
            $response = $this->apiGetWeather($lats[$x], $longs[$x]);
            if ($response['ErrFlag']) return $response;

            $response['name'] = $names[$x];
            if ($x == 0)
            {
                $tempData = [$response];                
            }
            else{
                array_push($tempData, $response);            
            }            
        }    
        $tempData['ErrFlag'] = false; 

        return $tempData;

        
    }

    public function apiGetLocation($location)
    {
       
        $error = '';
        $ERflag = false;
        
        $mapbox = config('services.mapbox.token');
        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$location}.json?limit=1&access_token={$mapbox}");
        $data = $response->json();
        //dd($data);
        if ($data == null) $error = "It seems like there is a connection failure.";   
        elseif (Count($data) == 1)$error = "Please enter a city and region before pressing enter or the 'Add' button";          
        elseif(Count($data['features']) == 0) $error = "I can't seem to find that location, try to be more specific";

        if ($error != '') 
        {
            $ERflag = true;
        }
        $data['ErrFlag'] = $ERflag;
        $data['error'] = $error;
        return $data;
    }

    public function apiGetWeather($lat, $long)
    {
        
        $error = '';
        $ERflag = false;
        $apikey = config('services.openweather.key');
        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$lat}&lon={$long}&exclude={part}&appid={$apikey}&units=imperial");
        $data = $response->json();
        
        
        //dd($data);
        if ($data == null) $error = "It seems like there is a connection failure.";          
        elseif (Count($data) < 6) $error = $data['message'];
        if ($error != '') 
        {
            $ERflag = true;
        }
        $data['ErrFlag'] = $ERflag;
        $data['error'] = $error;
        return $data;
    }


}
