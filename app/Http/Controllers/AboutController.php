<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;

class AboutController extends Controller
{
    public function index()
    {
        return view('about', ['title' => 'About Page']);
    }
}