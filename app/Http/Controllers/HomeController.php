<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;


use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ipList = explode(",", $ip);

     
        $currentUserInfo = Location::get($ipList[0]);
  


        $city = 'Lexington';
        if($currentUserInfo != false) 
        {
            $city = $currentUserInfo->cityName;
        }
        $response = (new WeatherController)->getWeather( $city);

        $name = $request->input('location');
        //dump($name);
       

        return view('home', 
        ['title' => 'Home Page'],
        ['city2' =>  $city,
        'currentWeather' => $response->json()]
        

    
        );
    }
}