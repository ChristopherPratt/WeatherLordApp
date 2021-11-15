<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;

class AboutController extends Controller
{
    public function index()
    {
        $response = (new WeatherController)->getWeather('Detroit');

        //dump($response->json());

        return view('about', ['title' => 'About Page']);
    }
}