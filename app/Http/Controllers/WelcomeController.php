<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class WelcomeController extends Controller
{
    public function index()
    {
        return view('/welcome', ['title' => 'Welcome Page']);
    }
}