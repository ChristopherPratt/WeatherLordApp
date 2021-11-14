<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;


class HomeController extends Controller
{
    public function index()
    {
        $response = (new WeatherController)->getWeather('Detroit');

        //dump($response->json());

        return view('home', 
        ['title' => 'Home Page'],
        ['currentWeather' => $response->json()]

    
        );
    }
}